<?php

namespace App\Application\Communication\DTOs;

use App\Domain\Communication\Enums\ContactRequestSource;
use App\Domain\Communication\Enums\ContactRequestStatus;
use Illuminate\Http\Request;

final readonly class CreateContactRequestData
{
    public function __construct(
        public string $fullName,
        public string $email,
        public ?string $phone,
        public ?string $subject,
        public string $message,
        public ContactRequestSource $source,
        public ContactRequestStatus $status,
        public ?string $notes = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            fullName: $request->string('full_name')->toString(),
            email: strtolower($request->string('email')->toString()),
            phone: $request->filled('phone') ? $request->string('phone')->toString() : null,
            subject: $request->filled('subject') ? $request->string('subject')->toString() : null,
            message: $request->string('message')->toString(),
            source: ContactRequestSource::from($request->input('source', ContactRequestSource::WEBSITE->value)),
            status: ContactRequestStatus::from($request->input('status', ContactRequestStatus::NEW->value)),
            notes: $request->filled('notes') ? $request->string('notes')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return [
            'full_name' => $this->fullName,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
            'source' => $this->source->value,
            'status' => $this->status->value,
            'notes' => $this->notes,
        ];
    }
}
