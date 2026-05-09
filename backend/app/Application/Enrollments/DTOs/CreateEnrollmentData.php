<?php

namespace App\Application\Enrollments\DTOs;

use App\Domain\Enrollments\Enums\EnrollmentPaymentStatus;
use App\Domain\Enrollments\Enums\EnrollmentStatus;
use Illuminate\Http\Request;

final readonly class CreateEnrollmentData
{
    public function __construct(
        public int $studentId,
        public int $programId,
        public int $cohortId,
        public string $enrollmentDate,
        public EnrollmentStatus $status,
        public EnrollmentPaymentStatus $paymentStatus,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            studentId: (int) $request->input('student_id'),
            programId: (int) $request->input('program_id'),
            cohortId: (int) $request->input('cohort_id'),
            enrollmentDate: $request->date('enrollment_date')?->toDateString() ?? now()->toDateString(),
            status: EnrollmentStatus::from($request->input('status', EnrollmentStatus::PENDING->value)),
            paymentStatus: EnrollmentPaymentStatus::from($request->input('payment_status', EnrollmentPaymentStatus::UNPAID->value)),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->studentId,
            'program_id' => $this->programId,
            'cohort_id' => $this->cohortId,
            'enrollment_date' => $this->enrollmentDate,
            'status' => $this->status->value,
            'payment_status' => $this->paymentStatus->value,
            'notes' => $this->notes,
        ];
    }
}
