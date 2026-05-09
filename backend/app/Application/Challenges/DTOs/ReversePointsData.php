<?php

namespace App\Application\Challenges\DTOs;

use App\Domain\Challenge\Enums\PointSourceType;
use App\Domain\Challenges\Enums\PointReason;
use Illuminate\Http\Request;

final readonly class ReversePointsData
{
    public function __construct(
        public int $userId,
        public PointReason $reason,
        public PointSourceType $sourceType,
        public int $sourceId,
        public int $points,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            userId: (int) $request->input('user_id'),
            reason: PointReason::from($request->input('reason', PointReason::PENALTY->value)),
            sourceType: PointSourceType::from($request->input('source_type')),
            sourceId: (int) $request->input('source_id'),
            points: -abs((int) $request->input('points')),
        );
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'reason' => $this->reason->value,
            'source_type' => $this->sourceType->value,
            'source_id' => $this->sourceId,
            'points' => $this->points,
        ];
    }
}
