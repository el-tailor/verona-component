<?php

namespace Verona\Component\HttpKernel;

use Verona\Component\Controller\Loader\ControllerLoader;
use Verona\Component\HttpFoundation\Request;
use Verona\Component\Routing\Router;

abstract class BaseKernel {

    private Request $request;

    public function __construct(string $base_path)
    {
        define("BASE_PATH", $base_path);
        $this->request = new Request();
        $this->init();
    }

    private function init() {
        $router = new Router();
        $route = $router->getRoute($this->request->getPath());
        new ControllerLoader($this->request, $route);
    }

}