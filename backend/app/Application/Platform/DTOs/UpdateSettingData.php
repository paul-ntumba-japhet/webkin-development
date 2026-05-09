<?php

namespace App\Application\Platform\DTOs;

use App\Domain\Platform\Enums\SettingType;
use Illuminate\Http\Request;

final readonly class UpdateSettingData
{
    public function __construct(
        public string $value,
        public SettingType $type,
        public ?string $group,
        public bool $isPublic,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            value: $request->string('value')->toString(),
            type: SettingType::from($request->input('type')),
            group: $request->filled('group') ? $request->string('group')->toString() : null,
            isPublic: $request->boolean('is_public'),
        );
    }

    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'type' => $this->type->value,
            'group' => $this->group,
            'is_public' => $this->isPublic,
        ];
    }
}
