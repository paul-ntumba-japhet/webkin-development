<?php

namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;

final readonly class ListUsersData
{
    public function __construct(
        public int $perPage = 20,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $perPage = (int) $request->input('per_page', 20);

        return new self(
            perPage: min(100, max(1, $perPage)),
        );
    }
}
