<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function paymentTransaction() { return $this->belongsTo(PaymentTransaction::class); }
}
