<?php


namespace App\Application\IdentityAccess\DTOs;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final readonly class UpdateRoleData
{
    public function __construct(
        public int $roleId,
        public ?string $name = null,
        public ?string $slug = null,
        public ?string $description = null,
    ) {}

    public static function fromRequest(Request $request, Role $role): self
    {
        return new self(
            roleId: $role->id,
            name: $request->filled('name') ? $request->string('name')->toString() : null,
            slug: $request->filled('slug') ? Str::slug($request->string('slug')->toString()) : null,
            description: $request->filled('description') ? $request->string('description')->toString() : null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
        ], static fn ($value) => $value !== null);
    }
}
