<?php

namespace Database\Seeders;

use App\Domain\IdentityAccess\Enums\RoleSlug;
use App\Domain\Users\Enums\UserStatus;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

/**
 * Crée le compte super-admin de bootstrap (Postman / premier accès staff).
 *
 * Prérequis : PermissionSeeder + RoleSeeder déjà exécutés.
 *
 * Exécution manuelle :
 *   php artisan db:seed --class=SuperAdminSeeder
 */
class SuperAdminSeeder extends Seeder
{
    private const EMAIL = 'paulinngudia836@gmail.com';

    private const PASSWORD = 'Paris2026##';

    public function run(): void
    {
        $role = Role::query()->where('slug', RoleSlug::SuperAdmin->value)->first();

        if ($role === null) {
            $this->command?->warn('SuperAdminSeeder: le rôle « super-admin » est absent. Lancez RoleSeeder d’abord.');

            return;
        }

        $user = User::query()->firstOrCreate(
            ['email' => self::EMAIL],
            [
                'first_name' => 'Paul',
                'last_name' => 'Ntumba',
                'phone' => '+243818791835',
                'password' => self::PASSWORD,
                'status' => UserStatus::ACTIVE,
            ],
        );

        $user->roles()->sync([$role->id]);

        $this->command?->info(sprintf(
            'Super-admin prêt : %s (mot de passe : %s)',
            self::EMAIL,
            self::PASSWORD,
        ));
    }
}
