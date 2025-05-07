<?php

declare(strict_types=1);

namespace App\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Task\AssignTaskRequestInterface;

class AssignTaskRequest extends FormRequest implements AssignTaskRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assignee_id' => ['required', 'uuid'],
        ];
    }

    public function getAssigneeId(): string
    {
        return $this->input('assignee_id');
    }
}
