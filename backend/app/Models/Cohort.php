<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function program() { return $this->belongsTo(Program::class); }
    public function weeklySchedules() { return $this->hasMany(CohortWeeklySchedule::class); }
    public function schedules() { return $this->hasMany(CohortSchedule::class); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
    public function assignments() { return $this->hasMany(Assignment::class); }
    public function studentProjects() { return $this->hasMany(StudentProject::class); }

}
