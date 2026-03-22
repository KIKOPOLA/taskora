<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Set the email attribute to lowercase.
     */
    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function projectMembers(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_members');
    }

    public function taskUpdates(): HasMany
    {
        return $this->hasMany(TaskUpdate::class, 'updated_by');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPM(): bool
    {
        return $this->role === 'pm';
    }

    public function isMember(): bool
    {
        return $this->role === 'member';
    }

    public function isDefault(): bool
    {
        return $this->role === 'default';
    }
}
