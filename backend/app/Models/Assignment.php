<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id',
        'module_id',
        'lesson_id',
        'cohort_id',
        'title',
        'description',
        'assignment_type',
        'due_date',
        'max_score',
        'is_published',
        'created_by',
    ];

    public function program() { return $this->belongsTo(Program::class); }
    public function module() { return $this->belongsTo(ProgramModule::class, 'module_id'); }
    public function lesson() { return $this->belongsTo(Lesson::class); }
    public function cohort() { return $this->belongsTo(Cohort::class); }
    public function creator() { return $this->belongsTo(User::class, 'created_by'); }
    public function submissions() { return $this->hasMany(AssignmentSubmission::class); }

}
