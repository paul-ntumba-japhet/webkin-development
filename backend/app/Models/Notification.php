<?php

namespace App\Models;

use App\Domain\Communication\Enums\NotificationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'title',
        'content',
        'read_at',
    ];

    protected function casts() : array
    {
        return [
            'user_id' => 'integer',
            'read_at' => 'datetime',
            'type' => NotificationType::class,
        ];
    }

    public function user() : BelongsTo { return $this->belongsTo(User::class); }
}
