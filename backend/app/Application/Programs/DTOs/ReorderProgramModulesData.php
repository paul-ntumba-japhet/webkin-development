<?php

namespace App\Application\Programs\DTOs;

use Illuminate\Http\Request;

final readonly class ReorderProgramModulesData
{
    /**
     * @param array<int, array{id:int, position:int}> $modules
     */
    public function __construct(
        public int $programId,
        public array $modules,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            programId: (int) $request->input('program_id'),
            modules: array_map(
                static fn (array $module): array => [
                    'id' => (int) $module['id'],
                    'position' => (int) $module['position'],
                ],
                $request->input('modules', [])
            ),
        );
    }
}
