<?php

declare(strict_types=1);

namespace App\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Task\CreateTaskRequestInterface;

class CreateTaskRequest extends FormRequest implements CreateTaskRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function getTitle(): string
    {
        return $this->input('title');
    }

    public function getDescription(): string
    {
        return $this->input('description');
    }
}
