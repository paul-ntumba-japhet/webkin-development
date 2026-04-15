<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssignmentReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'reviewer_id',
        'score',
        'feedback',
        'reviewed_at',
    ];

    protected function casts() : array
    {
        return [
            'submission_id' => 'integer',
            'reviewer_id' => 'integer',
            'score' => 'decimal:2',
            'reviewed_at' => 'datetime',
        ];
    }

    public function submission() : BelongsTo { return $this->belongsTo(AssignmentSubmission::class, 'submission_id'); }
    public function reviewer() : BelongsTo { return $this->belongsTo(User::class, 'reviewer_id'); }

}
