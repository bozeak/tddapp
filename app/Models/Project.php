<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded = [];

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
        $this->activity()->create(compact('description'));
    }
}
