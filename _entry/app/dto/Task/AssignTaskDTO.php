<?php

declare(strict_types=1);

namespace App\DTO\Task;

use App\Contracts\Task\AssignTaskRequestInterface;

readonly class AssignTaskDTO
{
    public string $taskId;
    public ?string $assigneeId;

    public function __construct(AssignTaskRequestInterface $request, string $taskId)
    {
        $this->assigneeId = $request->getAssigneeId();
        $this->taskId = $taskId;
    }
}
