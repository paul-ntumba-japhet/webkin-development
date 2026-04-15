<?php

namespace App\Domain\Assignments\Enums;

enum AssignmentType: string
{
    case HOMEWORK = 'homework';
    case QUIZ = 'quiz';
    case PROJECT = 'project';
    case EXAM = 'exam';

    public function label(): string
    {
        return match ($this) {
            self::HOMEWORK => 'Devoir',
            self::QUIZ => 'Quiz',
            self::PROJECT => 'Projet',
            self::EXAM => 'Examen',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
