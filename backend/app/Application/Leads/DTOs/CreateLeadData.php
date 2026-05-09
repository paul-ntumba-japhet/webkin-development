<?php

namespace App\Application\Leads\DTOs;

use App\Domain\Leads\Enums\LeadSource;
use App\Domain\Leads\Enums\LeadStatus;
use Illuminate\Http\Request;

final readonly class CreateLeadData
{
    public function __construct(
        public string $fullName,
        public ?string $phone,
        public ?string $email,
        public ?int $interestProgramId,
        public LeadSource $source,
        public ?string $message,
        public LeadStatus $status,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            fullName: $request->string('full_name')->toString(),
            phone: $request->filled('phone') ? $request->string('phone')->toString() : null,
            email: $request->filled('email') ? strtolower($request->string('email')->toString()) : null,
            interestProgramId: $request->filled('interest_program_id') ? (int) $request->input('interest_program_id') : null,
            source: LeadSource::from($request->input('source', LeadSource::WEBSITE->value)),
            message: $request->filled('message') ? $request->string('message')->toString() : null,
            status: LeadStatus::from($request->input('status', LeadStatus::NEW->value)),
        );
    }

    public function toArray(): array
    {
        return [
            'full_name' => $this->fullName,
            'phone' => $this->phone,
            'email' => $this->email,
            'interest_program_id' => $this->interestProgramId,
            'source' => $this->source->value,
            'message' => $this->message,
            'status' => $this->status->value,
        ];
    }
}
