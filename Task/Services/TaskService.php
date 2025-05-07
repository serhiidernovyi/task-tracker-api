<?php

declare(strict_types=1);

namespace Task\Services;

use Task\Entities\Task;
use Task\Enums\TaskStatus;
use App\DTO\Task\AssignTaskDTO;
use App\DTO\Task\CreateTaskDTO;
use App\DTO\Task\GetTasksDTO;
use Illuminate\Support\Str;
use App\DTO\Task\UpdateTaskStatusDTO;
use Task\Contracts\Entities\TaskInterface;
use Task\Contracts\Repositories\TaskRepositoryInterface;
use Task\Contracts\Services\TaskServiceInterface;

readonly class TaskService implements TaskServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $repository
    ) {}

    public function create(CreateTaskDTO $dto): TaskInterface
    {
        $task = new Task(
            id: (string) Str::uuid(),
            title: $dto->title,
            description: $dto->description,
            status: TaskStatus::TODO,
            assigneeId: $dto->userId,
            createdAt: now()->toDateTimeString(),
        );

        $this->repository->save($task);

        return $task;
    }

    public function getById(string $id): ?TaskInterface
    {
        return $this->repository->find($id);
    }

    public function getAll(GetTasksDTO $getTasksDTO): array
    {
        return $this->repository->all($getTasksDTO->status, $getTasksDTO->assigneeId);
    }

    public function updateStatus(UpdateTaskStatusDTO $dto): TaskInterface
    {
        $task = $this->repository->find($dto->taskId);

        if (!$task) {
            throw new \RuntimeException("Task not found");
        }

        $updatedTask = new Task(
            id: $task->getId(),
            title: $task->getTitle(),
            description: $task->getDescription(),
            status: $dto->taskStatus,
            assigneeId: $task->getAssigneeId(),
            createdAt: $task->getCreatedAt(),
            updatedAt: now()->toDateTimeString()
        );

        $this->repository->save($updatedTask);

        return $updatedTask;
    }

    public function assign(AssignTaskDTO $dto): TaskInterface
    {
        $task = $this->repository->find($dto->taskId);

        if (!$task) {
            throw new \RuntimeException("Task not found");
        }

        $updatedTask = new Task(
            id: $task->getId(),
            title: $task->getTitle(),
            description: $task->getDescription(),
            status: $task->getStatus(),
            assigneeId: $dto->assigneeId,
            createdAt: $task->getCreatedAt(),
            updatedAt: now()->toDateTimeString()
        );

        $this->repository->save($updatedTask);

        return $updatedTask;
    }
}