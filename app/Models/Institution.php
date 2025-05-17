<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'user_id', // assuming each institution belongs to a user
    ];

    // Relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
