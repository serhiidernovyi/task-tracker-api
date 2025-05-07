<?php

declare(strict_types=1);

namespace App\Requests\Task;

use Task\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Task\UpdateTaskRequestInterface;

class UpdateTaskStatusRequest extends FormRequest implements UpdateTaskRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['required', 'string', 'in:todo,in_progress,done'],
        ];
    }

    public function getTaskStatus(): TaskStatus
    {
        return TaskStatus::from($this->input('status'));
    }
}
