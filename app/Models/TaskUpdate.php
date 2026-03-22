<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'updated_by',
        'notes',
        'status',
        'image_path',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function files(): HasMany
    {
        return $this->hasMany(TaskFile::class)->latest();
    }
}
