<?php
namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class AlertMiddleware
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        $this->twig->addGlobal('alert', isset($_SESSION['alert']) ? $_SESSION['alert'] : []);
        if (isset($_SESSION['alert'])) {
            unset($_SESSION['alert']);
        }
        return $next($request, $response);
    }
}
