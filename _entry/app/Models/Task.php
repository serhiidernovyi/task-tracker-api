<?php

declare(strict_types=1);

namespace App\Models;

use Task\Enums\TaskStatus;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $title
 * @property string|null $description
 * @property string $status
 * @property string|null $assignee_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 */
class Task extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'assignee_id',
        'created_at',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
