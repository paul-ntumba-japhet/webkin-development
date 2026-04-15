<?php

namespace App\Models;

use App\Domain\Communication\Enums\StudentQuestionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'program_id',
        'module_id',
        'title',
        'question',
        'status',
    ];

    protected function casts() : array
    {
        return [
            'student_id' => 'integer',
            'program_id' => 'integer',
            'module_id' => 'integer',
            'status' => StudentQuestionStatus::class,
        ];
    }

    public function student() : BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function module() : BelongsTo { return $this->belongsTo(ProgramModule::class, 'module_id'); }
    public function answers() : HasMany { return $this->hasMany(QuestionAnswer::class, 'question_id'); }

}
