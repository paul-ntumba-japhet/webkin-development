<?php

namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;

final readonly class RequestPasswordResetData
{
    public function __construct(
        public string $email,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: strtolower($request->string('email')->toString()),
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
        ];
    }
}

