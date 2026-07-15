<?php

namespace App\Domain\Users\Enums;

enum UserStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case SUSPENDED = 'suspended';
    case DELETED = 'deleted';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Actif',
            self::INACTIVE => 'Inactif',
            self::SUSPENDED => 'Suspendu',
            self::DELETED => 'Supprimé',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function allowsAuthentication(): bool
    {
        return $this === self::ACTIVE;
    }

    public function authenticationBlockedMessage(): string
    {
        return match ($this) {
            self::SUSPENDED => __('auth.account_suspended'),
            self::INACTIVE => __('auth.account_inactive'),
            self::DELETED => __('auth.account_deleted'),
            self::ACTIVE => __('auth.account_disabled'),
        };
    }
}

