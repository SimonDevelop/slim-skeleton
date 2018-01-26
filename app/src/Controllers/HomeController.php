<?php
namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function getHome(RequestInterface $request, ResponseInterface $response)
    {
        $title = "Hello World!";
        $this->alert(['Ceci est un message flash']);
        $params = compact("title");
        $this->render($response, 'pages/home.php', $params);
    }

    // public function postHome(RequestInterface $request, ResponseInterface $response)
    // {
    //     return $this->redirect($response, 'home');
    // }
}
