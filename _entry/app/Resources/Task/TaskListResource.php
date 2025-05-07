<?php

declare(strict_types=1);

namespace App\Resources\Task;

use Illuminate\Support\Collection;
use Task\Contracts\Entities\TaskInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskListResource extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return $this->collection->map(function ($item) {
            /** @var TaskInterface $item */
            return [
                'id' => $item->getId(),
                'title' => $item->getTitle(),
                'description' => $item->getDescription(),
                'status' => $item->getStatus()->value,
                'assignee_id' => $item->getAssigneeId(),
                'created_at' => $item->getCreatedAt(),
                'updated_at' => $item->getUpdatedAt(),
            ];
        });
    }
}
