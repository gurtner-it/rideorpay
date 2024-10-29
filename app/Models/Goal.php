<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

    // Add user_id to the fillable properties
    protected $fillable = [
        'user_id',
        'target_hours',
    ];
}
