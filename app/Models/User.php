<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'institution_id',
    ];

    /**
     * The attributes that should be hidden for arrays / JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'institution_id' => 'integer',
    ];

    /**
     * Get the institution this user belongs to (nullable for admins).
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * Check if the user has the 'admin' role.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has the 'institution_user' role.
     */
    public function isInstitutionUser(): bool
    {
        return $this->role === 'institution_user';
    }
}
