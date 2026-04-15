<?php

namespace App\Models;

use App\Domain\Communication\Enums\SupportConversationStatus;
use App\Domain\Support\Enums\SupportCategory;
use App\Domain\Support\Enums\SupportPriority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportConversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'enrollment_id',
        'assigned_to_user_id',
        'subject',
        'category',
        'status',
        'priority',
        'last_message_at',
    ];

    protected function casts(): array
{
    return [
        'student_id' => 'integer',
        'enrollment_id' => 'integer',
        'assigned_to' => 'integer',
        'last_message_at' => 'datetime',
        'status' => SupportConversationStatus::class,
        'priority' => SupportPriority::class,
        'category' => SupportCategory::class,
    ];
}



    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function enrollment() { return $this->belongsTo(Enrollment::class); }
    public function assignee() { return $this->belongsTo(User::class, 'assigned_to'); }
    public function messages() { return $this->hasMany(SupportMessage::class, 'conversation_id'); }

}
