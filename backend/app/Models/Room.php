<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'capacity',
        'description',
    ];

    public function weeklySchedules() { return $this->hasMany(CohortWeeklySchedule::class); }
    public function schedules() { return $this->hasMany(CohortSchedule::class); }

}
