<?php

namespace App\Http\Resources\IdentityAccess;

use App\Domain\IdentityAccess\Services\PermissionResolverInterface;
use App\Domain\IdentityAccess\Services\PostLoginRedirectResolver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
final class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'city' => $this->city,
            'status' => $this->status->value,
            'avatar_media_id' => $this->avatar_media_id,
            'email_verified_at' => $this->email_verified_at?->toIso8601String(),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'permissions' => $this->when(
                $request->user()?->is($this->resource),
                fn () => app(PermissionResolverInterface::class)->permissionSlugsFor($this->resource),
            ),
            'dashboard_path' => $this->when(
                $request->user()?->is($this->resource),
                fn () => app(PostLoginRedirectResolver::class)->pathFor($this->resource),
            ),
        ];
    }
}
