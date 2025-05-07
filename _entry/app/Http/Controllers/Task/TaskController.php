<?php

declare(strict_types=1);

namespace App\Http\Controllers\Task;

use App\DTO\Task\AssignTaskDTO;
use App\DTO\Task\CreateTaskDTO;
use App\DTO\Task\GetTasksDTO;
use App\DTO\Task\UpdateTaskStatusDTO;
use App\Http\Controllers\Controller;
use App\Resources\Task\TaskResource;
use UseCases\Task\Task as TaskUseCase;
use App\Requests\Task\AssignTaskRequest;
use App\Requests\Task\CreateTaskRequest;
use App\Requests\Task\GetTasksRequest;
use App\Resources\Task\TaskListResource;
use App\Requests\Task\UpdateTaskStatusRequest;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function create(CreateTaskRequest $request, TaskUseCase $useCase): Response
    {
        $userId = auth()->id();
        $taskDto = new CreateTaskDTO($request, $userId);
        $task = $useCase->create($taskDto);
        $resource = new TaskResource($task);

        return $resource->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function getById(string $id, TaskUseCase $useCase): Response
    {
        $task = $useCase->getById($id);
        if (!$task) {
            return response([
                'error' => 'Task not found'
            ], Response::HTTP_NOT_FOUND);
        }

        return (new TaskResource($task))->response();
    }

    public function getAll(GetTasksRequest $request, TaskUseCase $useCase): Response
    {
        $taskDto = new GetTasksDTO($request);
        $tasks = $useCase->getAll($taskDto);
        $resource = new TaskListResource($tasks);

        return $resource->response()->setStatusCode(Response::HTTP_OK);
    }

    public function updateStatus(UpdateTaskStatusRequest $request, string $id, TaskUseCase $useCase): Response
    {
        $taskDto = new UpdateTaskStatusDTO($request, $id);
        $task = $useCase->updateStatus($taskDto);

        return (new TaskResource($task))->response();
    }

    public function assign(AssignTaskRequest $request, string $id, TaskUseCase $useCase): Response
    {
        $dto = new AssignTaskDTO($request, $id);
        $task = $useCase->assign($dto);

        return (new TaskResource($task))->response();
    }
}
