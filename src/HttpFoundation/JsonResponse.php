<?php

namespace Verona\Component\HttpFoundation;

class JsonResponse extends Response {

    public function __construct(array $data = [], int $code = 200, string $message = "OK") {
        $json_data = json_encode($data);
        parent::__construct($json_data, $code, $message);
    }

}
