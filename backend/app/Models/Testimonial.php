<?php

namespace App\Models;

use App\Domain\Media\Enums\TestimonialStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Testimonial extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'name',
        'role_label',
        'content',
        'video_url',
        'avatar_media_id',
        'rating',
        'is_featured',
        'status',
    ];

    protected function casts() : array
    {
        return [
            'student_id' => 'integer',
            'avatar_media_id' => 'integer',
            'rating' => 'integer',
            'is_featured' => 'boolean',
            'status' => TestimonialStatus::class,
        ];
    }

    public function student() : BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function avatarMedia() : BelongsTo { return $this->belongsTo(Media::class, 'avatar_media_id'); }

}
