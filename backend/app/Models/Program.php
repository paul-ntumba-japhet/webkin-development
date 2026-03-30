<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function coverMedia() { return $this->belongsTo(Media::class, 'cover_media_id'); }
    public function objectives() { return $this->hasMany(ProgramObjective::class); }
    public function careerOpportunities() { return $this->hasMany(ProgramCareerOpportunity::class); }
    public function resources() { return $this->hasMany(ProgramResource::class); }
    public function outcomeProjects() { return $this->hasMany(ProgramOutcomeProject::class); }
    public function showcases() { return $this->hasMany(ProgramShowcase::class); }
    public function modules() { return $this->hasMany(ProgramModule::class); }
    public function cohorts() { return $this->hasMany(Cohort::class); }
    public function enrollments() { return $this->hasMany(Enrollment::class); }
    public function assignments() { return $this->hasMany(Assignment::class); }
    public function studentProjects() { return $this->hasMany(StudentProject::class); }
    public function studentQuestions() { return $this->hasMany(StudentQuestion::class); }
    public function leads() { return $this->hasMany(Lead::class, 'interest_program_id'); }

}
