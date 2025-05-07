<?php

declare(strict_types=1);

namespace Task\Repositories;

use Task\Entities\Task;
use Task\Enums\TaskStatus;
use Task\Contracts\Entities\TaskInterface;
use Task\Contracts\Repositories\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    private array $storage = [];

    public function __construct()
    {
        $path = base_path('storage/app/tasks.json');

        if (!file_exists($path)) {
            logger()->warning("tasks.json not found at $path");
            return;
        }

        $json = file_get_contents($path);
        $items = json_decode($json, true);

        foreach ($items as $item) {
            $this->save(new Task(
                id: $item['id'],
                title: $item['title'],
                description: $item['description'],
                status: TaskStatus::from($item['status']),
                assigneeId: $item['assignee_id'],
                createdAt: $item['created_at'],
                updatedAt: $item['created_at'] ?? null
            ));
        }
    }

    public function save(TaskInterface $task): void
    {
        $this->storage[$task->getId()] = $task;
    }

    public function find(string $id): ?TaskInterface
    {
        return $this->storage[$id] ?? null;
    }

    public function all(?string $status = null, ?string $assigneeId = null): array
    {
        return array_values(array_filter($this->storage, function (TaskInterface $task) use ($status, $assigneeId) {
            return
                (!$status || $task->getStatus()->value === $status) &&
                (!$assigneeId || $task->getAssigneeId() === $assigneeId);
        }));
    }
}