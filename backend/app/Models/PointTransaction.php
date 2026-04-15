<?php

namespace App\Models;

use App\Domain\Challenge\Enums\PointSourceType;
use App\Domain\Challenges\Enums\PointReason;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PointTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'reason',
        'source_type',
        'source_id',
        'points',
    ];

    protected function casts() : array
    {
        return [
            'user_id' => 'integer',
            'source_id' => 'integer',
            'points' => 'integer',
            'reason' => PointReason::class,
            'source_type' => PointSourceType::class,
        ];
    }

    public function user() : BelongsTo { return $this->belongsTo(User::class); }
    public function source() : MorphTo { return $this->morphTo(); }

}
