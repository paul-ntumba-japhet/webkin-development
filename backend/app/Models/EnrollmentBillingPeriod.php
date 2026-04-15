<?php

namespace App\Models;

use App\Domain\Enrollments\Enums\BillingPeriodStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnrollmentBillingPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'period_number',
        'label',
        'period_start_date',
        'period_end_date',
        'due_date',
        'amount_due',
        'amount_paid',
        'balance_due',
        'status',
        'is_initial_payment',
    ];

    protected function casts() : array
    {
        return [
           'enrollment_id' => 'integer',
            'period_number' => 'integer',
            'amount_due' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'balance_due' => 'decimal:2',
            'period_start_date' => 'date',
            'period_end_date' => 'date',
            'due_date' => 'date',
            'is_initial_payment' => 'boolean',
            'status' => BillingPeriodStatus::class,
        ];
    }

    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }
    public function payments() : HasMany { return $this->hasMany(PaymentTransaction::class, 'billing_period_id'); }
}
