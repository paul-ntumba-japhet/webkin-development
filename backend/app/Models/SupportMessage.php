<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function conversation() { return $this->belongsTo(SupportConversation::class, 'conversation_id'); }
    public function sender() { return $this->belongsTo(User::class, 'sender_id'); }
    public function attachmentMedia() { return $this->belongsTo(Media::class, 'attachment_media_id'); }

}
