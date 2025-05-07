<?php

use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using   : function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api_v1.php'));
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'fake-auth' => \App\Http\Middleware\FakeAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->throttle(function (Throwable $e) {
            return match (get_class($e)) {
                BroadcastException::class => Limit::perMinute(300),
                default => Limit::none(),
            };
        });
        $exceptions->render(function (Throwable $e) use ($exceptions) {
            return match (get_class($e)) {
                ModelNotFoundException::class,
                RouteNotFoundException::class => response(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND),

                NotFoundHttpException::class,
                ValidationException::class,
                InvalidSignatureException::class => response(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST),

                MethodNotAllowedHttpException::class => response(['message' => $e->getMessage()], Response::HTTP_METHOD_NOT_ALLOWED),

                default => response(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST),
            };
        });
    })->create();
