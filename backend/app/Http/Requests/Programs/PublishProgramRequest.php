<?php

namespace App\Http\Requests\Programs;

use App\Models\Program;
use Illuminate\Foundation\Http\FormRequest;

final class PublishProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        $program = $this->route('program');

        if (! $program instanceof Program) {
            return false;
        }

        return $this->user()?->can('publish', $program) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [];
    }
}
