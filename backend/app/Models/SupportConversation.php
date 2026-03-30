<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportConversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'enrollment_id',
        'assigned_to',
        'subject',
        'category',
        'status',
        'priority',
        'last_message_at',
    ];

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function enrollment() { return $this->belongsTo(Enrollment::class); }
    public function assignee() { return $this->belongsTo(User::class, 'assigned_to'); }
    public function messages() { return $this->hasMany(SupportMessage::class, 'conversation_id'); }

}
