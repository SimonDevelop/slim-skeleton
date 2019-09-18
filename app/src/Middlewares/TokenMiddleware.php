<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class TokenMiddleware implements Middleware
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            $_SESSION['token'] = uniqid();
        }
        return $handler->handle($request);
    }
}
