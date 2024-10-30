<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    // Define the fillable columns for mass assignment
    protected $fillable = [
        'user_id',
        'strava_id',
        'name',
        'distance',
        'moving_time',
        'elevation_gain',
        'start_date',
    ];

    // Define data type casting
    protected $casts = [
        'distance' => 'float',
        'moving_time' => 'float',
        'elevation_gain' => 'float',
        'start_date' => 'datetime',
    ];

    

    /// Accessor for formatted distance
    public function getFormattedDistanceAttribute()
    {
        return round($this->distance / 1000, 2) . ' km'; // Convert to km and round
    }

    // Accessor for formatted elevation gain
    public function getFormattedElevationGainAttribute()
    {
        return round($this->elevation_gain) . ' m'; // Round elevation gain
    }

    // Accessor for formatted start date
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('d.m.Y H:i'); // Format date
    }

    /**
     * Format moving time in hours, minutes, and seconds
     */
    public function getFormattedMovingTimeAttribute()
    {
        $hours = floor($this->moving_time / 3600);
        $minutes = floor(($this->moving_time % 3600) / 60);
        $seconds = $this->moving_time % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    /**
     * Relationship with User model
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}