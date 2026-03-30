<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function enrollment() { return $this->belongsTo(Enrollment::class); }
    public function billingPeriod() { return $this->belongsTo(EnrollmentBillingPeriod::class, 'billing_period_id'); }
    public function initiator() { return $this->belongsTo(User::class, 'initiated_by_user_id'); }
    public function recorder() { return $this->belongsTo(User::class, 'recorded_by_admin_id'); }
    public function invoice() { return $this->hasOne(Invoice::class); }

}
