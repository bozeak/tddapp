<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    public $old = [];

    /**
     * @return string
     */
    public function path(): string
    {
        return "/projects/{$this->id}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * @param $body
     * @return Model
     */
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Activity::class)->latest();
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
            'description' => $description,
            'changes' => $this->activityChanges($description),
        ]);
    }

    /**
     * @return array|null
     */
    protected function activityChanges($description)
    {
        if ($description === 'updated') {
            return [
                'before' => Arr::except(array_diff($this->old, $this->getAttributes()), ['updated_at']),
                'after' => Arr::except($this->getChanges(), ['updated_at']),
            ];
        }
    }
}
