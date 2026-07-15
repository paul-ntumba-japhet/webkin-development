<?php

namespace App\Policies;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\Setting;
use App\Models\User;
use App\Policies\Concerns\AuthorizesWithPermission;

final class SettingPolicy
{
    use AuthorizesWithPermission;

    public function viewAny(User $user): bool
    {
        return $this->allowsPermission($user, PermissionSlug::SettingsManage);
    }

    public function update(User $user, Setting $setting): bool
    {
        return $this->allowsPermission($user, PermissionSlug::SettingsManage);
    }
}
