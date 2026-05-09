<?php

namespace App\Application\Communication\DTOs;

use App\Domain\Communication\Enums\StudentQuestionStatus;
use Illuminate\Http\Request;

final readonly class AnswerStudentQuestionData
{
    public function __construct(
        public int $questionId,
        public int $authorId,
        public string $answer,
        public bool $isAccepted = false,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            questionId: (int) $request->input('question_id'),
            authorId: (int) $request->input('author_id'),
            answer: $request->string('answer')->toString(),
            isAccepted: $request->boolean('is_accepted'),
        );
    }

    public function answerToArray(): array
    {
        return [
            'question_id' => $this->questionId,
            'author_id' => $this->authorId,
            'answer' => $this->answer,
            'is_accepted' => $this->isAccepted,
        ];
    }

    public function questionToArray(): array
    {
        return [
            'status' => StudentQuestionStatus::ANSWERED->value,
        ];
    }

    public function toArray(): array
    {
        return [
            'answer' => $this->answerToArray(),
            'question' => $this->questionToArray(),
        ];
    }
}
