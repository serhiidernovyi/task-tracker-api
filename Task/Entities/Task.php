<?php

namespace Task\Entities;

use Task\Enums\TaskStatus;
use Task\Contracts\Entities\TaskInterface;

class Task implements TaskInterface
{
    public function __construct(
        private string $id,
        private string $title,
        private ?string $description,
        private TaskStatus $status,
        private ?string $assigneeId,
        private string $createdAt,
        private ?string $updatedAt = null,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

    public function getAssigneeId(): ?string
    {
        return $this->assigneeId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt ?? '';
    }
}