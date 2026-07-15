<?php

namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;

final readonly class ResetPasswordData
{
    public function __construct(
        public string $email,
        public string $token,
        public string $password,
        public string $passwordConfirmation,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: strtolower($request->string('email')->toString()),
            token: $request->string('token')->toString(),
            password: $request->string('password')->toString(),
            passwordConfirmation: $request->string('password_confirmation')->toString(),
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'token' => $this->token,
            'password' => $this->password,
            'password_confirmation' => $this->passwordConfirmation,
        ];
    }
}
