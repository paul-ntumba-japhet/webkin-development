<?php

namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;

final readonly class ResetPasswordData
{
    public function __construct(
        public string $email,
        public string $token,
        public string $password,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: strtolower($request->string('email')->toString()),
            token: $request->string('token')->toString(),
            password: $request->string('password')->toString(),
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'token' => $this->token,
            'password' => $this->password,
        ];
    }
}
