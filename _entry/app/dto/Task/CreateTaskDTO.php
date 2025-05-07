<?php

declare(strict_types=1);

namespace App\DTO\Task;

use App\Contracts\Task\CreateTaskRequestInterface;

readonly class CreateTaskDTO
{
    public string $title;
    public ?string $description;
    public string $userId;

    public function __construct(CreateTaskRequestInterface $request, string $userId)
    {
        $this->title = $request->getTitle();
        $this->description = $request->getDescription();
        $this->userId = $userId;
    }
}
