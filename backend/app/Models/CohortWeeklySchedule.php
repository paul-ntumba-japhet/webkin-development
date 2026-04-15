<?php

namespace App\Models;

use App\Domain\Cohorts\Enums\DayOfWeek;
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

    protected function casts() : array
    {
        return [
            'cohort_id' => 'integer',
            'day_of_week' => DayOfWeek::class,
            'start_time' => 'datetime:H:i:s',
            'end_time' => 'datetime:H:i:s',
            'room_id' => 'integer',
        ];
    }

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
