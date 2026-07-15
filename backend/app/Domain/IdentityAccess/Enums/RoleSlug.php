<?php

namespace App\Domain\IdentityAccess\Enums;

enum RoleSlug: string
{
    case Student = 'student';
    case Admin = 'admin';
    case Editor = 'editor';
    case SuperAdmin = 'super-admin';

    public function label(): string
    {
        return match ($this) {
            self::Student => 'Étudiant',
            self::Admin => 'Administrateur',
            self::Editor => 'Éditeur',
            self::SuperAdmin => 'Super Administrateur',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Student => 'Étudiant',
            self::Admin => 'Administrateur du back-office',
            self::Editor => 'Éditeur du back-office',
            self::SuperAdmin => 'Super Administrateur du back-office',
        };
    }

    /** Tout rôle « staff » (hors simple étudiant). */
    public static function staffSlugs(): array
    {
        return [
            self::Admin->value,
            self::Editor->value,
            self::SuperAdmin->value,
        ];
    }

    /** Accès zone apprenant (/user). */
    public static function studentSlugs(): array
    {
        return [self::Student->value];
    }

    /** Accès zone administrateur (/admin). */
    public static function adminAreaSlugs(): array
    {
        return [self::Admin->value, self::SuperAdmin->value];
    }

    /** Accès zone éditeur (/admin). */
    public static function editorAreaSlugs(): array
    {
        return [self::Editor->value];
    }
}

