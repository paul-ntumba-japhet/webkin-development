<?php

namespace App\Domain\Leads\Enums;

enum LeadSource: string
{
    case WEBSITE = 'website';
    case WHATSAPP = 'whatsapp';
    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case LINKEDIN = 'linkedin';
    case REFERRAL = 'referral';
    case WALK_IN = 'walk_in';
    case EVENT = 'event';
    case MANUAL = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::WEBSITE => 'Site web',
            self::WHATSAPP => 'WhatsApp',
            self::FACEBOOK => 'Facebook',
            self::INSTAGRAM => 'Instagram',
            self::LINKEDIN => 'LinkedIn',
            self::REFERRAL => 'Recommandation',
            self::WALK_IN => 'Visite directe',
            self::EVENT => 'Événement',
            self::MANUAL => 'Ajout manuel',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
