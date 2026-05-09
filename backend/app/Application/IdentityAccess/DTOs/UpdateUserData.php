<?php

namespace App\Application\IdentityAccess\DTOs;

use App\Domain\Users\Enums\UserStatus;
use Illuminate\Http\Request;

final readonly class UpdateUserData
{
    public function __construct(
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?int $avatarMediaId = null,
        public ?string $bio = null,
        public ?string $city = null,
        public ?UserStatus $status = null,
        public ?array $roleIds = null,
        public ?string $emailVerifiedAt = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            firstName: $request->filled('first_name') ? $request->string('first_name')->toString() : null,
            lastName: $request->filled('last_name') ? $request->string('last_name')->toString() : null,
            email: $request->filled('email') ? strtolower($request->string('email')->toString()) : null,
            phone: $request->filled('phone') ? $request->string('phone')->toString() : null,
            avatarMediaId: $request->filled('avatar_media_id') ? (int) $request->input('avatar_media_id') : null,
            bio: $request->filled('bio') ? $request->string('bio')->toString() : null,
            city: $request->filled('city') ? $request->string('city')->toString() : null,
            status: $request->filled('status') ? UserStatus::from($request->input('status')) : null,
            roleIds: $request->filled('role_ids') ? array_map('intval', (array) $request->input('role_ids')) : null,
            emailVerifiedAt: $request->filled('email_verified_at') ? $request->input('email_verified_at') : null,
        );
    }

    public function userAttributes(): array
    {
        return array_filter([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'avatar_media_id' => $this->avatarMediaId,
            'bio' => $this->bio,
            'city' => $this->city,
            'status' => $this->status?->value,
            'email_verified_at' => $this->emailVerifiedAt,
        ], static fn ($value) => $value !== null);
    }

    public function toArray(): array
    {
        return $this->userAttributes();
    }
}
