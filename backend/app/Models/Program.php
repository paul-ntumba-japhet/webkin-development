<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'long_description',
        'curriculum_summary',
        'duration_value',
        'duration_unit',
        'professional_outcomes',
        'status',
        'is_featured',
        'cover_media_id',
    ];

    public function coverMedia() : BelongsTo { return $this->belongsTo(Media::class, 'cover_media_id'); }
    public function objectives() : HasMany { return $this->hasMany(ProgramObjective::class); }
    public function careerOpportunities() : HasMany { return $this->hasMany(ProgramCareerOpportunity::class); }
    public function resources() : HasMany { return $this->hasMany(ProgramResource::class); }
    public function outcomeProjects() : HasMany { return $this->hasMany(ProgramOutcomeProject::class); }
    public function showcases() : HasMany { return $this->hasMany(ProgramShowcase::class); }
    public function modules() : HasMany { return $this->hasMany(ProgramModule::class); }
    public function cohorts() : HasMany { return $this->hasMany(Cohort::class); }
    public function enrollments() : HasMany { return $this->hasMany(Enrollment::class); }
    public function assignments() : HasMany { return $this->hasMany(Assignment::class); }
    public function studentProjects() : HasMany { return $this->hasMany(StudentProject::class); }
    public function studentQuestions() : HasMany { return $this->hasMany(StudentQuestion::class); }
    public function leads() : HasMany { return $this->hasMany(Lead::class, 'interest_program_id'); }

}
