<?php

namespace App\Application\Challenges\DTOs;

use App\Domain\Challenges\Enums\ChallengeStatus;
use Illuminate\Http\Request;

final readonly class ArchiveChallengeData
{
    public function __construct(
        public ?string $publishedAt = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            publishedAt: $request->date('published_at')?->toDateTimeString(),
        );
    }

    public function toArray(): array
    {
        return [
            'status' => ChallengeStatus::ARCHIVED->value,
            'published_at' => $this->publishedAt,
        ];
    }
}
