<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'capacity',
        'description',
    ];

    public function weeklySchedules() : HasMany { return $this->hasMany(CohortWeeklySchedule::class); }
    public function schedules() : HasMany { return $this->hasMany(CohortSchedule::class); }

}
