<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cohort extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_id',
        'name',
        'start_date',
        'end_date',
        'max_students',
        'price',
        'status',
        'notes',
    ];

    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function weeklySchedules() : HasMany { return $this->hasMany(CohortWeeklySchedule::class); }
    public function schedules() : HasMany { return $this->hasMany(CohortSchedule::class); }
    public function enrollments() : HasMany { return $this->hasMany(Enrollment::class); }
    public function assignments() : HasMany { return $this->hasMany(Assignment::class); }
    public function studentProjects() : HasMany { return $this->hasMany(StudentProject::class); }

}
