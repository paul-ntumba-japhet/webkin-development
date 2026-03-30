<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProject extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'program_id',
        'cohort_id',
        'title',
        'slug',
        'description',
        'stack_summary',
        'github_url',
        'demo_url',
        'cover_media_id',
        'status',
        'is_featured',
        'published_at',
    ];

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function program() { return $this->belongsTo(Program::class); }
    public function cohort() { return $this->belongsTo(Cohort::class); }
    public function coverMedia() { return $this->belongsTo(Media::class, 'cover_media_id'); }
    public function members() { return $this->hasMany(ProjectMember::class, 'project_id'); }

}
