<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    protected function casts() : array
    {
        return [
            'program_id' => 'integer',
            'position' => 'integer',
        ];
    }

    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function lessons() : HasMany { return $this->hasMany(Lesson::class, 'module_id'); }
    public function schedules() : HasMany { return $this->hasMany(CohortSchedule::class, 'module_id'); }
    public function assignments() : HasMany { return $this->hasMany(Assignment::class, 'module_id'); }
    public function studentQuestions() : HasMany { return $this->hasMany(StudentQuestion::class, 'module_id'); }

}
