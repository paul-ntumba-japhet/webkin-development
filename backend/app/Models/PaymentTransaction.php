<?php

namespace App\Models;

use App\Domain\Payments\Enums\PaymentChannel;
use App\Domain\Payments\Enums\PaymentMethod;
use App\Domain\Payments\Enums\PaymentProvider;
use App\Domain\Payments\Enums\PaymentTransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected function casts() : array
    {
        return [
            'enrollment_id' => 'integer',
            'billing_period_id' => 'integer',
            'initiated_by_user_id' => 'integer',
            'recorded_by_admin_id' => 'integer',
            'amount' => 'decimal:2',
            'metadata' => 'array',
            'paid_at' => 'datetime',
            'confirmed_at' => 'datetime',
            'payment_method' => PaymentMethod::class,
            'payment_channel' => PaymentChannel::class,
            'provider' => PaymentProvider::class,
            'status' => PaymentTransactionStatus::class,
        ];
    }

    public function enrollment() : BelongsTo { return $this->belongsTo(Enrollment::class); }
    public function billingPeriod() : BelongsTo { return $this->belongsTo(EnrollmentBillingPeriod::class, 'billing_period_id'); }
    public function initiator() : BelongsTo { return $this->belongsTo(User::class, 'initiated_by_user_id'); }
    public function recorder() : BelongsTo { return $this->belongsTo(User::class, 'recorded_by_admin_id'); }
    public function invoice() : HasOne { return $this->hasOne(Invoice::class); }

}
