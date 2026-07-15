<?php

namespace App\Domain\IdentityAccess\Enums;

enum PermissionSlug: string
{
    // Users
    case UsersView = 'users.view';
    case UsersManage = 'users.manage';
    case UsersCreate = 'users.create';
    case UsersUpdate = 'users.update';
    case UsersDelete = 'users.delete';

    // Programs / curriculum
    case ProgramsView = 'programs.view';
    case ProgramsPublish = 'programs.publish';

    // Enrollments
    case EnrollmentsApprove = 'enrollments.approve';

    // Assignments
    case AssignmentsReview = 'assignments.review';
    case AssignmentsSubmit = 'assignments.submit';

    // Cohorts / instructor
    case CohortsManageSchedules = 'cohorts.manage_schedules';

    // Platform
    case SettingsManage = 'settings.manage';

    public function label(): string
    {
        return match ($this) {
            self::UsersView => 'Voir les utilisateurs',
            self::UsersManage => 'Gérer les utilisateurs',
            self::UsersCreate => 'Créer un utilisateur',
            self::UsersUpdate => 'Mettre à jour un utilisateur',
            self::UsersDelete => 'Supprimer un utilisateur',
        };
    }
}

