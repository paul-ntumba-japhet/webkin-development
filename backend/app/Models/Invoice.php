<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_transaction_id',
        'invoice_number',
        'amount',
        'issued_at',
        'file_path',
    ];

    protected function casts() : array
    {
        return [
            'payment_transaction_id' => 'integer',
            'amount' => 'decimal:2',
            'issued_at' => 'datetime',
        ];
    }

    public function paymentTransaction() : BelongsTo { return $this->belongsTo(PaymentTransaction::class); }
}
