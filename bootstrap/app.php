<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Middleware\OnlyMe;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['onlyMe' => OnlyMe::class]);
        $middleware->alias(['role' => RoleMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle 401 errors for API routes
        $exceptions->render(function (AuthenticationException $e, Request $request): JsonResponse|null {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated.'
                ], 401);
            }

            return null; // fallback for non-API requests
        });
    })
    ->create();