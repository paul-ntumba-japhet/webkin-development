<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModule extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_id',
        'title',
        'description',
        'position',
        'estimated_duration',
    ];

    public function program() { return $this->belongsTo(Program::class); }
    public function lessons() { return $this->hasMany(Lesson::class, 'module_id'); }
    public function schedules() { return $this->hasMany(CohortSchedule::class, 'module_id'); }
    public function assignments() { return $this->hasMany(Assignment::class, 'module_id'); }
    public function studentQuestions() { return $this->hasMany(StudentQuestion::class, 'module_id'); }

}
