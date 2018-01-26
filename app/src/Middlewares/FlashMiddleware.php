<?php
namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class FlashMiddleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (isset($_SESSION['Flash'])) {
            unset($_SESSION['Flash']);
        }
        if (isset($_SESSION['slimFlash'])) {
            $_SESSION['Flash'] = $_SESSION['slimFlash'];
            unset($_SESSION['slimFlash']);
        }
        return $next($request, $response);
    }
}
