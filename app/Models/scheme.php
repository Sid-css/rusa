<?php
// app/Models/Scheme.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    // Relationships
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
    public function schemeDetail()
    {
        return $this->belongsTo(SchemeDetail::class);
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Helpers used in view
    public function getTotalApprovedAmount(): float
    {
        return $this->projects->sum('approved_amount');
    }

    public function getTotalReceivedAmount(): float
    {
        return $this->projects->sum('received_amount');
    }
}
