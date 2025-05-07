<?php

declare(strict_types=1);

namespace App\Contracts\Task;

interface GetTasksRequestInterface
{
    public function getStatus(): ?string;
    public function getAssigneeId(): ?string;
}
