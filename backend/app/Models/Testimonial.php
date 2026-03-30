<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function avatarMedia() { return $this->belongsTo(Media::class, 'avatar_media_id'); }

}
