<?php

namespace App\Application\Billing\DTOs;

use Illuminate\Http\Request;

final readonly class GenerateInvoiceData
{
    public function __construct(
        public int $paymentTransactionId,
        public string $invoiceNumber,
        public string $amount,
        public string $issuedAt,
        public ?string $filePath = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            paymentTransactionId: (int) $request->input('payment_transaction_id'),
            invoiceNumber: $request->string('invoice_number')->toString(),
            amount: number_format((float) $request->input('amount', 0), 2, '.', ''),
            issuedAt: $request->date('issued_at')?->toDateTimeString() ?? now()->toDateTimeString(),
            filePath: $request->filled('file_path') ? $request->string('file_path')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'payment_transaction_id' => $this->paymentTransactionId,
            'invoice_number' => $this->invoiceNumber,
            'amount' => $this->amount,
            'issued_at' => $this->issuedAt,
            'file_path' => $this->filePath,
        ];
    }
}
