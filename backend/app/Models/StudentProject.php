<?php

namespace App\Models;

use App\Domain\Projects\Enums\StudentProjectStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected function casts() : array
    {
        return [
            'student_id' => 'integer',
        'program_id' => 'integer',
        'cohort_id' => 'integer',
        'cover_media_id' => 'integer',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'status' => StudentProjectStatus::class,

        ];
    }

    public function student() : BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function cohort() : BelongsTo { return $this->belongsTo(Cohort::class); }
    public function coverMedia() : BelongsTo { return $this->belongsTo(Media::class, 'cover_media_id'); }
    public function members() : HasMany { return $this->hasMany(ProjectMember::class, 'project_id'); }

}
