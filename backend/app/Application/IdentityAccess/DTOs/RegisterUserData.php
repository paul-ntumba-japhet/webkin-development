<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Domain\Users\Enums\UserStatus;
use Illuminate\Http\Request;


final readonly class RegisterUserData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password,
        public ?string $phone = null,
        public ?string $bio = null,
        public ?string $city = null,
        public ?int $avatarMediaId = null,
        public UserStatus $status = UserStatus::ACTIVE,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            firstName: $request->string('first_name')->toString(),
            lastName: $request->string('last_name')->toString(),
            email: strtolower($request->string('email')->toString()),
            password: $request->string('password')->toString(),
            phone: $request->filled('phone') ? $request->string('phone')->toString() : null,
            bio: $request->filled('bio') ? $request->string('bio')->toString() : null,
            city: $request->filled('city') ? $request->string('city')->toString() : null,
            avatarMediaId: $request->filled('avatar_media_id') ? (int) $request->input('avatar_media_id') : null,
            status: $request->filled('status')
                ? UserStatus::from($request->input('status'))
                : UserStatus::ACTIVE,
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => $this->password,
            'avatar_media_id' => $this->avatarMediaId,
            'bio' => $this->bio,
            'city' => $this->city,
            'status' => $this->status->value,
        ];
    }
}
