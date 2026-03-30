<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename',
        'original_name',
        'mime_type',
        'extension',
        'size',
        'disk',
        'path',
        'url',
        'type',
        'uploaded_by',
    ];
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
    public function userAvatars() { return $this->hasMany(User::class, 'avatar_media_id'); }
    public function programCovers() { return $this->hasMany(Program::class, 'cover_media_id'); }
    public function programResources() { return $this->hasMany(ProgramResource::class, 'media_id'); }
    public function outcomeProjectThumbnails() { return $this->hasMany(ProgramOutcomeProject::class, 'thumbnail_media_id'); }
    public function showcaseMediaUsages() { return $this->hasMany(ProgramShowcase::class, 'media_id'); }
    public function showcaseThumbnailUsages() { return $this->hasMany(ProgramShowcase::class, 'thumbnail_media_id'); }
    public function lessonResources() { return $this->hasMany(LessonResource::class, 'media_id'); }
    public function assignmentSubmissionFiles() { return $this->hasMany(AssignmentSubmission::class, 'file_media_id'); }
    public function studentProjectCovers() { return $this->hasMany(StudentProject::class, 'cover_media_id'); }
    public function testimonialAvatars() { return $this->hasMany(Testimonial::class, 'avatar_media_id'); }
    public function supportMessageAttachments() { return $this->hasMany(SupportMessage::class, 'attachment_media_id'); }

}
