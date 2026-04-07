<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function module() : BelongsTo { return $this->belongsTo(ProgramModule::class, 'module_id'); }
    public function lesson() : BelongsTo { return $this->belongsTo(Lesson::class); }
    public function cohort() : BelongsTo { return $this->belongsTo(Cohort::class); }
    public function creator() : BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
    public function submissions() : HasMany { return $this->hasMany(AssignmentSubmission::class); }

}
