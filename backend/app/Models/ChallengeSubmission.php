<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChallengeSubmission extends Model
{
    use HasFactory;
    protected $fillable = [
        'challenge_id',
        'student_id',
        'repository_url',
        'live_url',
        'submission_text',
        'score',
        'feedback',
        'submitted_at',
        'reviewed_by_user_id',
        'reviewed_at',
        'status',
    ];

    public function challenge() { return $this->belongsTo(Challenge::class); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewed_by'); }

}
