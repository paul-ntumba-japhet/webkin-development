<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CohortWeeklySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'cohort_id',
        'day_of_week',
        'start_time',
        'end_time',
        'room_id',
    ];

    public function cohort()
    {
        return $this->belongsTo(Cohort::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function schedules()
    {
        return $this->hasMany(CohortSchedule::class);
    }

}
