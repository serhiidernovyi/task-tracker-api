<?php

declare(strict_types=1);

namespace Task\Contracts\Entities;

use Task\Enums\TaskStatus;

interface TaskInterface
{
    public function getId(): string;

    public function getTitle(): string;

    public function getDescription(): ?string;

    public function getStatus(): TaskStatus;

    public function getAssigneeId(): ?string;

    public function getCreatedAt(): string;

    public function getUpdatedAt(): string;
}