<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'billing_period_id',
        'initiated_by_user_id',
        'recorded_by_admin_id',
        'payment_method',
        'payment_channel',
        'provider',
        'transaction_reference',
        'external_reference',
        'amount',
        'currency',
        'status',
        'paid_at',
        'confirmed_at',
        'metadata',
        'notes',
    ];

    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }
    public function billingPeriod() : BelongsTo { return $this->belongsTo(EnrollmentBillingPeriod::class, 'billing_period_id'); }
    public function initiator() : BelongsTo { return $this->belongsTo(User::class, 'initiated_by_user_id'); }
    public function recorder() : BelongsTo { return $this->belongsTo(User::class, 'recorded_by_admin_id'); }
    public function invoice() : HasOne { return $this->hasOne(Invoice::class); }

}
