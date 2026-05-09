<?php

namespace App\Application\Billing\DTOs;

use App\Domain\Enrollments\Enums\BillingPeriodStatus;
use Illuminate\Http\Request;

final readonly class CreateEnrollmentBillingPeriodData
{
    public function __construct(
        public int $enrollmentId,
        public int $periodNumber,
        public string $label,
        public string $periodStartDate,
        public string $periodEndDate,
        public string $dueDate,
        public string $amountDue,
        public string $amountPaid,
        public string $balanceDue,
        public BillingPeriodStatus $status,
        public bool $isInitialPayment,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $amountDue = number_format((float) $request->input('amount_due', 0), 2, '.', '');
        $amountPaid = number_format((float) $request->input('amount_paid', 0), 2, '.', '');
        $balanceDue = number_format((float) $request->input('balance_due', (float) $amountDue - (float) $amountPaid), 2, '.', '');

        return new self(
            enrollmentId: (int) $request->input('enrollment_id'),
            periodNumber: (int) $request->input('period_number'),
            label: $request->string('label')->toString(),
            periodStartDate: $request->date('period_start_date')?->toDateString() ?? now()->toDateString(),
            periodEndDate: $request->date('period_end_date')?->toDateString() ?? now()->toDateString(),
            dueDate: $request->date('due_date')?->toDateString() ?? now()->toDateString(),
            amountDue: $amountDue,
            amountPaid: $amountPaid,
            balanceDue: $balanceDue,
            status: BillingPeriodStatus::from($request->input('status', BillingPeriodStatus::PENDING->value)),
            isInitialPayment: $request->boolean('is_initial_payment'),
        );
    }

    public function toArray(): array
    {
        return [
            'enrollment_id' => $this->enrollmentId,
            'period_number' => $this->periodNumber,
            'label' => $this->label,
            'period_start_date' => $this->periodStartDate,
            'period_end_date' => $this->periodEndDate,
            'due_date' => $this->dueDate,
            'amount_due' => $this->amountDue,
            'amount_paid' => $this->amountPaid,
            'balance_due' => $this->balanceDue,
            'status' => $this->status->value,
            'is_initial_payment' => $this->isInitialPayment,
        ];
    }
}
