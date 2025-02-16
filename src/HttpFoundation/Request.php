<?php

namespace Verona\Component\HttpFoundation;

use Verona\Component\HttpFoundation\Files\UploadFile;

final class Request {

    private string $path;
    private InputBag $query;
    private InputBag $request;
    private string $method;
    private UploadFile $files;

    public function __construct()
    {
        $this->path = "/" . trim(strtolower(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)), "/");
        $this->method = strtolower($_SERVER["REQUEST_METHOD"]);
        $this->query = new InputBag($_GET);
        $this->request = new InputBag($_POST);
        $this->files = UploadFile::getInstance();
        $this->init();
    }

    private function init() {
        unset($_GET);
        unset($_POST);
    }

    public function query() : InputBag {
        return $this->query;
    }

    public function request() : InputBag {
        return $this->request;
    }

    public function getPath() : string {
        return $this->path;
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function isMethod(string $method) {
        return $this->method === $method;
    }

    public function getFiles() : ?UploadFile {
        return $this->files;
    }

}