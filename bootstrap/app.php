<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use App\Responses\JSResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\AuthenticationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: [__DIR__.'/../routes/api.php', __DIR__.'/../routes/admin.php'],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return JSResponse::notFoundException('url does not exist.');
            }
        });

        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return JSResponse::methodNotAllowedHttpException('The ' . $request->method() . ' method is not supported for this route. Supported methods: ' . implode(', ', $e->getHeaders()));
        });

        $exceptions->render(function (AuthenticationException $e, Request $request) {
            return JSResponse::authenticationException('You are not authenticated to access this resource.');
        });
    })->create();
