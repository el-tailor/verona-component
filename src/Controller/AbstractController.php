<?php 

namespace Verona\Component\Controller;

use Verona\Component\HttpFoundation\Request;
use Verona\Component\HttpFoundation\Response;

abstract class AbstractController {

    private array $data = [];

    public function getResponse(Request $request) : array {
        $response = match(strtolower($request->getMethod())) {
            'get' => $this->doGet($request),
            'post' => $this->doPost($request),
            default => null
        };
        return array("response" => $response, "data" => $this->data);
    }


    protected function doGet(Request $request) : ?Response {
        return null;
    }

    protected function doPost(Request $request) : ?Response {
        return null;
    }

    protected function render(string $template, array $data) : ?Response {
        $this->data = $data;
        $filename = BASE_PATH . "/templates/".$template;
        return new Response($filename);
    }

}