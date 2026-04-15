<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Media\Enums\MediaType;

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

    protected function casts() : array
    {
        return [
            'size' => 'integer',
            'uploaded_by' => 'integer',
            'type' => MediaType::class,
        ];
    }


    public function uploader() : BelongsTo { return $this->belongsTo(User::class, 'uploaded_by'); }
    public function userAvatars() : HasMany { return $this->hasMany(User::class, 'avatar_media_id'); }
    public function programCovers() : HasMany { return $this->hasMany(Program::class, 'cover_media_id'); }
    public function programResources() : HasMany { return $this->hasMany(ProgramResource::class, 'media_id'); }
    public function outcomeProjectThumbnails() : HasMany { return $this->hasMany(ProgramOutcomeProject::class, 'thumbnail_media_id'); }
    public function showcaseMediaUsages() : HasMany { return $this->hasMany(ProgramShowcase::class, 'media_id'); }
    public function showcaseThumbnailUsages() : HasMany { return $this->hasMany(ProgramShowcase::class, 'thumbnail_media_id'); }
    public function lessonResources() : HasMany { return $this->hasMany(LessonResource::class, 'media_id'); }
    public function assignmentSubmissionFiles() : HasMany { return $this->hasMany(AssignmentSubmission::class, 'file_media_id'); }
    public function studentProjectCovers() : HasMany { return $this->hasMany(StudentProject::class, 'cover_media_id'); }
    public function testimonialAvatars() : HasMany { return $this->hasMany(Testimonial::class, 'avatar_media_id'); }
    public function supportMessageAttachments() : HasMany { return $this->hasMany(SupportMessage::class, 'attachment_media_id'); }

}
