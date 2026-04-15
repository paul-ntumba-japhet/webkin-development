<?php

namespace App\Domain\Communication\Enums;

enum ContactRequestSource: string
{
    case WEBSITE = 'website';
    case CONTACT_FORM = 'contact_form';
    case WHATSAPP = 'whatsapp';
    case FACEBOOK = 'facebook';
    case INSTAGRAM = 'instagram';
    case EMAIL = 'email';
    case PHONE = 'phone';
    case MANUAL = 'manual';

    public function label(): string
    {
        return match ($this) {
            self::WEBSITE => 'Site web',
            self::CONTACT_FORM => 'Formulaire de contact',
            self::WHATSAPP => 'WhatsApp',
            self::FACEBOOK => 'Facebook',
            self::INSTAGRAM => 'Instagram',
            self::EMAIL => 'Email',
            self::PHONE => 'Téléphone',
            self::MANUAL => 'Ajout manuel',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

