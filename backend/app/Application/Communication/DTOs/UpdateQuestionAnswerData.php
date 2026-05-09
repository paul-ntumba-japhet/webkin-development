<?php

namespace App\Application\Communication\DTOs;

use Illuminate\Http\Request;

final readonly class UpdateQuestionAnswerData
{
    public function __construct(
        public string $answer,
        public bool $isAccepted,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            answer: $request->string('answer')->toString(),
            isAccepted: $request->boolean('is_accepted'),
        );
    }

    public function toArray(): array
    {
        return [
            'answer' => $this->answer,
            'is_accepted' => $this->isAccepted,
        ];
    }
}
