<?php

namespace App\Application\Payments\DTOs;

use App\Domain\Payments\Enums\PaymentChannel;
use App\Domain\Payments\Enums\PaymentMethod;
use App\Domain\Payments\Enums\PaymentProvider;
use App\Domain\Payments\Enums\PaymentTransactionStatus;
use Illuminate\Http\Request;

final readonly class CreatePaymentTransactionData
{
    /**
     * @param array<string, mixed>|null $metadata
     */
    public function __construct(
        public int $enrollmentId,
        public ?int $billingPeriodId,
        public ?int $initiatedByUserId,
        public ?int $recordedByAdminId,
        public PaymentMethod $paymentMethod,
        public PaymentChannel $paymentChannel,
        public ?PaymentProvider $provider,
        public ?string $transactionReference,
        public ?string $externalReference,
        public string $amount,
        public string $currency,
        public PaymentTransactionStatus $status,
        public ?string $paidAt,
        public ?array $metadata,
        public ?string $notes,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            enrollmentId: (int) $request->input('enrollment_id'),
            billingPeriodId: $request->filled('billing_period_id') ? (int) $request->input('billing_period_id') : null,
            initiatedByUserId: $request->filled('initiated_by_user_id') ? (int) $request->input('initiated_by_user_id') : null,
            recordedByAdminId: $request->filled('recorded_by_admin_id') ? (int) $request->input('recorded_by_admin_id') : null,
            paymentMethod: PaymentMethod::from($request->input('payment_method')),
            paymentChannel: PaymentChannel::from($request->input('payment_channel')),
            provider: $request->filled('provider') ? PaymentProvider::from($request->input('provider')) : null,
            transactionReference: $request->filled('transaction_reference') ? $request->string('transaction_reference')->toString() : null,
            externalReference: $request->filled('external_reference') ? $request->string('external_reference')->toString() : null,
            amount: number_format((float) $request->input('amount', 0), 2, '.', ''),
            currency: strtoupper($request->string('currency')->toString() ?: 'USD'),
            status: PaymentTransactionStatus::from($request->input('status', PaymentTransactionStatus::PENDING->value)),
            paidAt: $request->date('paid_at')?->toDateTimeString(),
            metadata: $request->input('metadata'),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'enrollment_id' => $this->enrollmentId,
            'billing_period_id' => $this->billingPeriodId,
            'initiated_by_user_id' => $this->initiatedByUserId,
            'recorded_by_admin_id' => $this->recordedByAdminId,
            'payment_method' => $this->paymentMethod->value,
            'payment_channel' => $this->paymentChannel->value,
            'provider' => $this->provider?->value,
            'transaction_reference' => $this->transactionReference,
            'external_reference' => $this->externalReference,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'status' => $this->status->value,
            'paid_at' => $this->paidAt,
            'metadata' => $this->metadata,
            'notes' => $this->notes,
        ];
    }
}
