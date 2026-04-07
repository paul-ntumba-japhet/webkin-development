<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AssignmentSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'assignment_id',
        'student_id',
        'submission_text',
        'repository_url',
        'file_media_id',
        'submitted_at',
        'status',
    ];

    public function assignment() : BelongsTo { return $this->belongsTo(Assignment::class); }
    public function student() : BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function fileMedia() : BelongsTo { return $this->belongsTo(Media::class, 'file_media_id'); }
    public function review() : HasOne { return $this->hasOne(AssignmentReview::class, 'submission_id'); }

}
