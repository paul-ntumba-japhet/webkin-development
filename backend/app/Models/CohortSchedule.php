<?php

namespace App\Models;

use App\Domain\Cohorts\Enums\CohortSessionStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CohortSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'cohort_id',
        'cohort_weekly_schedule_id',
        'instructor_id',
        'module_id',
        'lesson_id',
        'room_id',
        'scheduled_date',
        'start_time',
        'end_time',
        'session_type',
        'status',
        'title',
        'notes',
    ];

    protected $casts = [
        'cohort_id' => 'integer',
        'module_id' => 'integer',
        'lesson_id' => 'integer',
        'instructor_id' => 'integer',
        'room_id' => 'integer',
        'session_date' => 'date',
        'start_time' => 'datetime:H:i:s',
        'end_time' => 'datetime:H:i:s',
        'status' => CohortSessionStatus::class,
        //'mode' => DeliveryMode::class,
    ];

    public function cohort() : BelongsTo
    {
        return $this->belongsTo(Cohort::class);
    }

    public function weeklySchedule() : BelongsTo
    {
        return $this->belongsTo(CohortWeeklySchedule::class, 'cohort_weekly_schedule_id');
    }

    public function instructor() : BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function module() : BelongsTo
    {
        return $this->belongsTo(ProgramModule::class, 'module_id');
    }

    public function lesson() : BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }

    public function room() : BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function attendances() : HasMany
    {
        return $this->hasMany(Attendance::class, 'schedule_id');
    }
}
