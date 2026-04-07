<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }
    public function payments() : HasMany { return $this->hasMany(PaymentTransaction::class, 'billing_period_id'); }
}
