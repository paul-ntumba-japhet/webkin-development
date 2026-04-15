<?php

namespace App\Models;

use App\Domain\Challenges\Enums\ChallengeSubmissionStatus;
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

    protected function casts(): array
    {
        return [
            'challenge_id' => 'integer',
            'student_id' => 'integer',
            'reviewed_by' => 'integer',
            'score' => 'integer',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'status' => ChallengeSubmissionStatus::class,
        ];
    }

    public function challenge() { return $this->belongsTo(Challenge::class); }
    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function reviewer() { return $this->belongsTo(User::class, 'reviewed_by'); }

}
