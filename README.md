# Task Tracker API (Laravel 12, DDD, In-Memory)

## Architecture

The system follows a layered DDD-style structure:

- **Controller**: Handles HTTP input/output
- **Request**: Validates data
- **DTO**: Transfers validated input to business logic
- **UseCase**: Coordinates execution of specific operations
- **Service**: Contains core business rules
- **Repository Interface**: Abstract data access
- **In-Memory Repository**: Reads/writes to `storage/app/tasks.json` (mocked persistence)
- **Entity Interface**: Task contract
- **Entity Implementation**: Task value object

## Design Patterns & Concepts Used

- **Repository Pattern** — abstraction for task persistence (in-memory JSON)
- **DTO (Data Transfer Object)** — input encapsulation with strict typing
- **Strategy Pattern** — applied through decoupled UseCase execution logic
- **Dependency Injection** — via Laravel service container (`singleton()`)
- **Service Layer Pattern** — separates business logic from controllers and infrastructure
- **Custom Exception Handling** — centralized via `DomainServiceException`
- **Fake Authentication** — lightweight middleware injects in-memory user via `Auth::setUser(...)`
- **PSR-4 Autoloading & Namespaces** — clean structure with DDD-style modules
- **Laravel 12 Application Skeleton** — no `Kernel.php`, uses new `bootstrap/app.php` approach

## ▶️ How to Run
docker compose up -d

-- Enter the application container:
docker exec -ti task_app bash

-- Install dependencies:
cd _entry
composer install

-- Set up environment
cp .env.example .env
php artisan key:generate

-- Verify routes (optional):
php artisan route:list

API will be available at http://localhost:8000/api/v1


🧩 How to Extend This Architecture

✅ 1. Task Comments
•	Add a Comment entity and CommentRepositoryInterface
•	Each task can have a hasMany relationship with Comment
•	Use DTOs for creating/updating comments
•	Add POST /tasks/{id}/comments, GET /tasks/{id}/comments

✅ 2. User Roles (admin, developer, etc.)
•	Extend the in-memory User with a role field
•	Create an enum for roles
•	Add middleware for RoleGuard (e.g., ->middleware('role:admin'))
•	Replace fake user with token-based (e.g., Laravel Sanctum)

✅ 3. Database Persistence
•	Swap TaskRepositoryInterface binding from TaskRepository (in-memory) to a database-backed repository (e.g., EloquentTaskRepository)
•	Keep the same interface — zero impact on use cases or services

✅ 4. Swagger Documentation
•	Add DarkaOnLine/L5-Swagger or knife/swagger-laravel
•	Annotate controllers with @OA comments
•	Generate docs at /api/documentation

✅ 5. Automated Tests
•	Add tests/Feature/TaskApiTest.php
•	Test all endpoints: GET, POST, PATCH
•	Use RefreshDatabase or MockRepository depending on storage
•	Optionally: inject TaskRepositoryInterface with a test double
