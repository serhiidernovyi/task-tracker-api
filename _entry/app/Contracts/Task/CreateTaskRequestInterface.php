<?php

declare(strict_types=1);

namespace App\Contracts\Task;

interface CreateTaskRequestInterface
{
    public function getTitle(): string;
    public function getDescription(): string;
}
