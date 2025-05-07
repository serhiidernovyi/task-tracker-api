<?php

declare(strict_types=1);

namespace Task\Contracts\Repositories;

use Task\Contracts\Entities\TaskInterface;

interface TaskRepositoryInterface
{
    public function save(TaskInterface $task): void;

    public function find(string $id): ?TaskInterface;

    /**
     * @return TaskInterface[]
     */
    public function all(?string $status = null, ?string $assigneeId = null): array;
}