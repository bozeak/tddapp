<?php

namespace App;

use App\Models\Activity;
use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;

trait RecordsActivity
{

    /**
     * The project's old attributes.
     *
     * @var array
     */
    public $oldAttributes = [];

    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {
        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getRawOriginal();
                });
            }
        }
    }

    /**
     * @param $description
     * @return string
     */
    protected function activityDescription($description): string
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * Records the activity.
     *
     * @param string $description
     *
     * @return void
     */
    public function recordActivity(string $description)
    {
        $this->activity()->create([
            'user_id' => ($this->project ?? $this)->owner->id,
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
        ]);
    }

    /**
     * @return array|null
     */
    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), ['updated_at']),
                'after' => Arr::except($this->getChanges(), ['updated_at']),
            ];
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|MorphMany
     */
    public function activity()
    {
        if (get_class($this) === Project::class) {
            return $this->hasMany(Activity::class)->latest();
        }

        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    /**
     * @return string[]
     */
    protected static function recordableEvents(): array
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }
        return ['created', 'updated'];
    }
}
