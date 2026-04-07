<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Challenge extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'difficulty',
        'category',
        'instructions',
        'starter_code_url',
        'solution_url',
        'max_points',
        'status',
        'published_at',
    ];

    public function submissions() : HasMany { return $this->hasMany(ChallengeSubmission::class); }
    public function pointTransactions() : MorphMany { return $this->morphMany(PointTransaction::class, 'source'); }

}
