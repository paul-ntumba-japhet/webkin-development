<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\GetUserData;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

final class GetUserAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function execute(User $actor, GetUserData $data): User
    {
        $user = $this->users->findById($data->userId);

        if ($user === null) {
            throw ValidationException::withMessages([
                'user_id' => [trans('validation.exists', ['attribute' => 'user'])],
            ]);
        }

        Gate::forUser($actor)->authorize('view', $user);

        return $user->load(['roles']);
    }
}
