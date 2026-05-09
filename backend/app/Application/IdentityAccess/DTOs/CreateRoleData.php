<?php


namespace App\Application\IdentityAccess\DTOs;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

final readonly class CreateRoleData
{
    public function __construct(
        public string $name,
        public string $slug,
        public ?string $description = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        $name = $request->string('name')->toString();

        return new self(
            name: $name,
            slug: $request->filled('slug')
                ? Str::slug($request->string('slug')->toString())
                : Str::slug($name),
            description: $request->filled('description')
                ? $request->string('description')->toString()
                : null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ];
    }
}
