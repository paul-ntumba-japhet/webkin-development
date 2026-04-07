<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupportMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message',
        'attachment_media_id',
        'is_internal',
        'read_at',
    ];

    public function conversation() : BelongsTo { return $this->belongsTo(SupportConversation::class, 'conversation_id'); }
    public function sender() : BelongsTo { return $this->belongsTo(User::class, 'sender_id'); }
    public function attachmentMedia() : BelongsTo { return $this->belongsTo(Media::class, 'attachment_media_id'); }

}
