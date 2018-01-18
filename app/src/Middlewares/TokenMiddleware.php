<?php
namespace App\Middlewares;

use Slim\Http\Request;
use Slim\Http\Response;

class TokenMiddleware
{
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            $_SESSION['token'] = uniqid();
        }
        $this->twig->addGlobal('token', $_SESSION['token']);
        $response = $next($request, $response);
        if ($response->getStatusCode() === 400) {
            $_SESSION['token'] = $request->getParams();
        }
        return $response;
    }
}
