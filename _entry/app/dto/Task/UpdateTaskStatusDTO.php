<?php

declare(strict_types=1);

namespace App\DTO\Task;

use Task\Enums\TaskStatus;
use App\Contracts\Task\UpdateTaskRequestInterface;

readonly class UpdateTaskStatusDTO
{
    public TaskStatus $taskStatus;
    public string $taskId;

    public function __construct(UpdateTaskRequestInterface $request, string $taskId)
    {
        $this->taskStatus = $request->getTaskStatus();
        $this->taskId = $taskId;
    }
}
