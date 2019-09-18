<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends Controller
{
    public function getHome(RequestInterface $request, ResponseInterface $response)
    {
        $title = "Hello World!";

        $csrf = $this->csrf;
        $csrfNameKey = $csrf->getTokenNameKey();
        $csrfValueKey = $csrf->getTokenValueKey();
        $csrfName = $request->getAttribute($csrfNameKey);
        $csrfValue = $request->getAttribute($csrfValueKey);

        $params = compact("title", "csrfNameKey", "csrfValueKey", "csrfName", "csrfValue");
        return $this->render($response, "pages/home.php", $params);
    }

    public function postHome(RequestInterface $request, ResponseInterface $response)
    {
        if ($request->getAttribute('csrf_status') !== false) {
            $params = $request->getParsedBody();
            $_SESSION['name'] = $params["name"];
            $this->alert(['Vous êtes connecté']);
            return $this->redirect($response, 'home');
        } else {
            $this->alert(['Formulaire invalide'], "danger");
            return $this->redirect($response, 'home');
        }
    }
}
