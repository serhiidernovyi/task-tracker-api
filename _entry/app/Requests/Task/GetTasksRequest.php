<?php

declare(strict_types=1);

namespace App\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Task\GetTasksRequestInterface;

class GetTasksRequest extends FormRequest implements GetTasksRequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['nullable', 'string', 'in:todo,in_progress,done'],
            'assignee_id' => ['nullable', 'uuid'],
        ];
    }

    public function getStatus(): ?string
    {
        return $this->query('status');
    }

    public function getAssigneeId(): ?string
    {
        return $this->query('assignee_id');
    }
}
