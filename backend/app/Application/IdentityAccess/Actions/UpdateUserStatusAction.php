<?php

namespace App\Application\IdentityAccess\Actions;

use App\Application\IdentityAccess\DTOs\UpdateUserStatusData;
use App\Domain\IdentityAccess\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

final class UpdateUserStatusAction
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {}

    public function execute(User $actor, UpdateUserStatusData $data): User
    {
        $user = $this->users->findById($data->userId);

        if ($user === null) {
            throw ValidationException::withMessages([
                'user_id' => [trans('validation.exists', ['attribute' => 'user'])],
            ]);
        }

        Gate::forUser($actor)->authorize('update', $user);

        $user = $this->users->update($user, $data->userAttributes());

        if (! $user->canAuthenticate()) {
            $user->revokeAllAccessTokens();
        }

        return $user;
    }
}
