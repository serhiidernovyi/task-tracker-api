<?php

declare(strict_types=1);

namespace UseCases\Task;

use App\DTO\Task\AssignTaskDTO;
use App\DTO\Task\CreateTaskDTO;
use App\DTO\Task\GetTasksDTO;
use Task\Services\TaskService;
use UseCases\DomainServiceFactory;
use App\DTO\Task\UpdateTaskStatusDTO;
use Task\Contracts\Entities\TaskInterface;
use Task\Contracts\Services\TaskServiceInterface;

readonly class Task
{
    public function __construct(
        private DomainServiceFactory $domainServiceFactory,
    ) {
    }

    /**
     * @throws \Throwable
     */
    public function create(CreateTaskDTO $taskDto): TaskInterface
    {
        /** @var TaskService $taskService */
        $taskService = $this->domainServiceFactory->create(TaskServiceInterface::class);
        return $taskService->create($taskDto);
    }

    public function getById(string $id): ?TaskInterface
    {
        /** @var TaskService $taskService */
        $taskService = $this->domainServiceFactory->create(TaskServiceInterface::class);
        return $taskService->getById($id);
    }

    public function getAll(GetTasksDTO $tasksDto): array
    {
        /** @var TaskService $taskService */
        $taskService = $this->domainServiceFactory->create(TaskServiceInterface::class);
        return $taskService->getAll($tasksDto);
    }

    public function updateStatus(UpdateTaskStatusDTO $dto): TaskInterface
    {
        /** @var TaskService $taskService */
        $service = $this->domainServiceFactory->create(TaskServiceInterface::class);
        return $service->updateStatus($dto);
    }

    public function assign(AssignTaskDTO $dto): TaskInterface
    {
        /** @var TaskService $taskService */
        $taskService = $this->domainServiceFactory->create(TaskServiceInterface::class);
        return $taskService->assign($dto);
    }
}