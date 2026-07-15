<?php

namespace Database\Seeders;

use App\Domain\IdentityAccess\Enums\PermissionSlug;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::definitions() as $definition) {
            Permission::query()->firstOrCreate(
                ['slug' => $definition['slug']],
                [
                    'name' => $definition['name'],
                    'description' => $definition['description'],
                    'group' => $definition['group'],
                ],
            );
        }
    }

    /**
     * @return list<array{slug: string, name: string, description: string|null, group: string}>
     */
    private static function definitions(): array
    {
        return [
            [
                'slug' => PermissionSlug::UsersView->value,
                'name' => 'Voir les utilisateurs',
                'description' => 'Consulter la liste et le détail des comptes.',
                'group' => 'users',
            ],
            [
                'slug' => PermissionSlug::UsersManage->value,
                'name' => 'Gérer les utilisateurs',
                'description' => 'Administration globale des comptes (hors création unitaire).',
                'group' => 'users',
            ],
            [
                'slug' => PermissionSlug::UsersCreate->value,
                'name' => 'Créer un utilisateur',
                'description' => 'Créer un compte depuis le back-office.',
                'group' => 'users',
            ],
            [
                'slug' => PermissionSlug::UsersUpdate->value,
                'name' => 'Mettre à jour un utilisateur',
                'description' => 'Modifier le profil et les rôles d’un compte.',
                'group' => 'users',
            ],
            [
                'slug' => PermissionSlug::UsersDelete->value,
                'name' => 'Supprimer un utilisateur',
                'description' => 'Désactiver ou supprimer un compte.',
                'group' => 'users',
            ],
            [
                'slug' => PermissionSlug::ProgramsView->value,
                'name' => 'Voir les programmes',
                'description' => 'Consulter le catalogue et le contenu des programmes.',
                'group' => 'programs',
            ],
            [
                'slug' => PermissionSlug::ProgramsPublish->value,
                'name' => 'Publier un programme',
                'description' => 'Publier ou dépublier un programme.',
                'group' => 'programs',
            ],
            [
                'slug' => PermissionSlug::EnrollmentsApprove->value,
                'name' => 'Approuver une inscription',
                'description' => 'Valider ou refuser une demande d’inscription.',
                'group' => 'enrollments',
            ],
            [
                'slug' => PermissionSlug::AssignmentsSubmit->value,
                'name' => 'Soumettre un devoir',
                'description' => 'Déposer une soumission d’assignment.',
                'group' => 'assignments',
            ],
            [
                'slug' => PermissionSlug::AssignmentsReview->value,
                'name' => 'Corriger un devoir',
                'description' => 'Noter et commenter les soumissions.',
                'group' => 'assignments',
            ],
            [
                'slug' => PermissionSlug::CohortsManageSchedules->value,
                'name' => 'Gérer les plannings',
                'description' => 'Créer et modifier les créneaux de cohorte.',
                'group' => 'cohorts',
            ],
            [
                'slug' => PermissionSlug::SettingsManage->value,
                'name' => 'Paramètres plateforme',
                'description' => 'Modifier les réglages globaux de la plateforme.',
                'group' => 'platform',
            ],
        ];
    }
}
