<?php

declare(strict_types=1);

namespace App\Contracts\Task;

interface AssignTaskRequestInterface
{
    public function getAssigneeId(): string;
}
