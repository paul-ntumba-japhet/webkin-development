<?php

namespace App\Models;

use App\Domain\Challenges\Enums\ChallengeCategory;
use App\Domain\Challenges\Enums\ChallengeStatus;
use App\Domain\Curriculum\Enums\DifficultyLevel;
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

    protected function casts() : array
    {
        return [
              'max_points' => 'integer',
              'published_at' => 'datetime',
              'difficulty' => DifficultyLevel::class,
              'category' => ChallengeCategory::class,
              'status' => ChallengeStatus::class,
        ];
    }

    public function submissions() : HasMany { return $this->hasMany(ChallengeSubmission::class); }
    public function pointTransactions() : MorphMany { return $this->morphMany(PointTransaction::class, 'source'); }

}
