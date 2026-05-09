<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class ReorderLessonsData
{
    /**
     * @param array<int, array{id:int, position:int}> $lessons
     */
    public function __construct(
        public int $programModuleId,
        public array $lessons,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            programModuleId: (int) $request->input('program_module_id'),
            lessons: array_map(
                static fn (array $lesson): array => [
                    'id' => (int) $lesson['id'],
                    'position' => (int) $lesson['position'],
                ],
                $request->input('lessons', [])
            ),
        );
    }
}
