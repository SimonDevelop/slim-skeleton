<?php
namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class AlertMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (isset($_SESSION['alert'])) {
            unset($_SESSION['alert']);
        }
        if (isset($_SESSION['alert2'])) {
            $_SESSION['alert'] = $_SESSION['alert2'];
            unset($_SESSION['alert2']);
        }
        return $next($request, $response);
    }
}
