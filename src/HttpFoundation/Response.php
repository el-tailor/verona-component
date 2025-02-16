<?php

namespace Verona\Component\HttpFoundation;

class Response extends HttpResponse {

    public function __construct(
        protected string $content = "",
        private int $code = 200,
        private string $message = "OK"
    ) {}

    public function getStatusCode() : int { return $this->code; }

    public function getContent() : string {
        return $this->content;
    }

    public function getMessage() : string { return $this->message; }

}