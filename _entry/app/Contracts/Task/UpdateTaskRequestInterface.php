<?php

declare(strict_types=1);

namespace App\Contracts\Task;

use Task\Enums\TaskStatus;

interface UpdateTaskRequestInterface
{
    public function getTaskStatus(): TaskStatus;
}
