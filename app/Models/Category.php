<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable = ['name', 'user_id'];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function completedTasks()
    {
        return $this->hasMany(Task::class)->where('status', 'done');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    public function invitedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->where('type', 'invited');
    }

}
