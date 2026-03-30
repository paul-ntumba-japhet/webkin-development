<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function program() { return $this->belongsTo(Program::class); }
    public function module() { return $this->belongsTo(ProgramModule::class, 'module_id'); }
    public function answers() { return $this->hasMany(QuestionAnswer::class, 'question_id'); }

}
