<?php
namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class TokenMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            $_SESSION['token'] = uniqid();
        }
        return $next($request, $response);
    }
}
