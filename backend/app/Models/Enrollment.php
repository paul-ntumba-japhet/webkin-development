<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'program_id',
        'cohort_id',
        'enrollment_date',
        'status',
        'payment_status',
        'validated_at',
        'validated_by',
        'notes',
    ];

    public function student() { return $this->belongsTo(User::class, 'student_id'); }
    public function program() { return $this->belongsTo(Program::class); }
    public function cohort() { return $this->belongsTo(Cohort::class); }
    public function validator() { return $this->belongsTo(User::class, 'validated_by'); }
    public function billingPeriods() { return $this->hasMany(EnrollmentBillingPeriod::class); }
    public function paymentTransactions() { return $this->hasMany(PaymentTransaction::class); }
    public function attendanceEntries() { return $this->hasMany(Attendance::class); }
    public function progressEntries() { return $this->hasMany(StudentProgress::class); }
    public function mentorshipSessions() { return $this->hasMany(MentorshipSession::class); }
    public function supportConversations() { return $this->hasMany(SupportConversation::class); }

}
