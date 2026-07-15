<?php

namespace App\Http\Requests\Admin;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use Illuminate\Foundation\Http\FormRequest;

final class AssignRolePermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->hasPermission(PermissionSlug::UsersManage) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'permission_ids' => ['present', 'array'],
            'permission_ids.*' => ['integer', 'exists:permissions,id'],
        ];
    }
}
