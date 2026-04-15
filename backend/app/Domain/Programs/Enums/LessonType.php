<?php

namespace App\Domain\Programs\Enums;

enum LessonType : string
{
    case TEXT = 'text';
    case VIDEO = 'video';
    case LIVE = 'live';
    case QUIZ = 'quiz';
    case PROJECT = 'project';

    public function label(): string
    {
        return match($this) {
            self::TEXT => 'Texte',
            self::VIDEO => 'Vidéo',
            self::LIVE => 'En direct',
            self::QUIZ => 'Quiz',
            self::PROJECT => 'Projet',
        };
    }

    public static function values(): array
    {
        return array_map(fn($type) => $type->value, self::cases());
    }

}
