<?php

namespace Verona\Component\Controller\Loader;

use Exception;
use ReflectionClass;
use Verona\Component\Controller\AbstractController;
use Verona\Component\HttpFoundation\Request;
use Verona\Component\HttpFoundation\Response;
use Verona\Component\Routing\Route;

final class ControllerLoader {

    public function __construct(private Request $request, private ?Route $route)
    {
        $this->findController();
    }

    private function findController() {
        try {
            if (is_null($this->route)) throw new Exception("No Route Found For path : " . $this->request->getPath());
            $rController = new ReflectionClass($this->route->controller);
            $controller = $rController->newInstance();
            $this->sendResponse($controller);
        }catch(Exception $e) {
            header("HTTP/1.1 404 " . $e->getMessage());
            echo $e;
            exit;
        }
    }

    private function sendResponse(AbstractController $controller) {
        $response = $controller->getResponse($this->request);
        if (is_null($response)) throw new Exception("No Response Found");
        $this->execute($response["response"], $response["data"]);
    }

    private function execute(Response $response, array $data) {
        header("HTTP/1.1 {$response->getStatusCode()} {$response->getMessage()}");
        extract($data);
        if (is_file($response->getContent())) require_once $response->getContent();
        else echo $response->getContent();
    }

}