<?php

namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;

final readonly class LoginData
{
    public function __construct(
        public string $email,
        public string $password,
        public bool $remember = false,
        public ?string $deviceName = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: strtolower($request->string('email')->toString()),
            password: $request->string('password')->toString(),
            remember: $request->boolean('remember'),
            deviceName: $request->filled('device_name')
                ? $request->string('device_name')->toString()
                : null,
        );
    }

    public function credentials(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'remember' => $this->remember,
            'device_name' => $this->deviceName,
        ];
    }
}
