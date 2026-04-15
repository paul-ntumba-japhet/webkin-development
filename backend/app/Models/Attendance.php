<?php

namespace App\Models;

use App\Domain\Attendance\Enums\AttendanceStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'enrollment_id',
        'schedule_id',
        'status',
        'check_in_time',
        'remark',
    ];

    protected function casts() : array
    {
        return [
            'enrollment_id' => 'integer',
        'schedule_id' => 'integer',
        'check_in_time' => 'datetime',
        'status' => AttendanceStatus::class,
        ];
    }

    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }
    public function schedule() : BelongsTo { return $this->belongsTo(CohortSchedule::class, 'schedule_id'); }

}
