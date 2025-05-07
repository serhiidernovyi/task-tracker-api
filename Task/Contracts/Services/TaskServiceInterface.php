<?php

namespace Task\Contracts\Services;

use App\DTO\Task\AssignTaskDTO;
use App\DTO\Task\CreateTaskDTO;
use App\DTO\Task\GetTasksDTO;
use App\DTO\Task\UpdateTaskStatusDTO;
use Task\Contracts\Entities\TaskInterface;

interface TaskServiceInterface
{
    public function create(CreateTaskDTO $dto): TaskInterface;
    public function getById(string $id): ?TaskInterface;
    public function getAll(GetTasksDTO $getTasksDTO): array;
    public function updateStatus(UpdateTaskStatusDTO $dto): TaskInterface;
    public function assign(AssignTaskDTO $dto): TaskInterface;
}