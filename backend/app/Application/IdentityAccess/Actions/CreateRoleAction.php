<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\CreateRoleData;
use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Domain\IdentityAccess\Repositories\RoleRepositoryInterface;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

final class CreateRoleAction
{
    public function __construct(
        private readonly RoleRepositoryInterface $roles,
    ) {}

    public function execute(User $actor, CreateRoleData $data): Role
    {
        if (! $actor->hasPermission(PermissionSlug::UsersManage)) {
            throw new AuthorizationException;
        }

        if ($this->roles->findBySlug($data->slug) !== null) {
            throw ValidationException::withMessages([
                'slug' => [trans('validation.unique', ['attribute' => 'slug'])],
            ]);
        }

        return $this->roles->create($data->toArray());
    }
}
