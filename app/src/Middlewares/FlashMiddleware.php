<?php
namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class FlashMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (isset($_SESSION['flash'])) {
            unset($_SESSION['flash']);
        }
        if (isset($_SESSION['flash2'])) {
            $_SESSION['flash'] = $_SESSION['flash2'];
            unset($_SESSION['flash2']);
        }
        return $next($request, $response);
    }
}
