<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function cohort() : BelongsTo
    {
        return $this->belongsTo(Cohort::class);
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function schedules() : HasMany
    {
        return $this->hasMany(CohortSchedule::class);
    }

}
