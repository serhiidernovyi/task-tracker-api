<?php

declare(strict_types=1);

namespace App\DTO\Task;

use App\Contracts\Task\GetTasksRequestInterface;

readonly class GetTasksDTO
{
    public ?string $status;
    public ?string $assigneeId;

    public function __construct(GetTasksRequestInterface $request)
    {
        $this->status = $request->getStatus();
        $this->assigneeId = $request->getAssigneeId();
    }
}
