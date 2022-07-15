<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $touches = ['project'];

    /**
     * @var string[]
     */
    protected $casts = [
        'completed' => 'boolean'
    ];

    /**
     * @return void
     */
    public function complete()
    {
        $this->update(['completed' => true]);

        $this->recordActivity('completed_task');
    }

    /**
     * @return void
     */
    public function incomplete()
    {
        $this->update(['completed' => false]);

        $this->recordActivity('incompleted_task');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return "/projects/{$this->project->id}/tasks/{$this->id}";
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
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
            'project_id' => $this->project_id,
            'description' => $description,
        ]);
    }
}
