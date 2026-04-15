<?php

namespace App\Models;

use App\Domain\Enrollments\Enums\EnrollmentPaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Domain\Enrollments\Enums\EnrollmentStatus;
use App\Domain\Payments\Enums\PaymentStatus;

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
        'validated_by_user_id',
        'notes',
    ];

    protected function casts() : array
    {
        return [
            'student_id' => 'integer',
            'program_id' => 'integer',
            'cohort_id' => 'integer',
            'enrollment_date' => 'date',
            'status' => EnrollmentStatus::class,
            'payment_status' => EnrollmentPaymentStatus::class,
            'validated_at' => 'datetime',
            'validated_by_user_id' => 'integer',
        ];
    }

    public function student() : BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function program() : BelongsTo { return $this->belongsTo(Program::class); }
    public function cohort() : BelongsTo { return $this->belongsTo(Cohort::class); }
    public function validator() : BelongsTo { return $this->belongsTo(User::class, 'validated_by'); }
    public function billingPeriods() : HasMany { return $this->hasMany(EnrollmentBillingPeriod::class); }
    public function paymentTransactions() : HasMany { return $this->hasMany(PaymentTransaction::class); }
    public function attendanceEntries() : HasMany { return $this->hasMany(Attendance::class); }
    public function progressEntries() : HasMany { return $this->hasMany(StudentProgress::class); }
    public function mentorshipSessions() : HasMany { return $this->hasMany(MentorshipSession::class); }
    public function supportConversations() : HasMany { return $this->hasMany(SupportConversation::class); }

}
