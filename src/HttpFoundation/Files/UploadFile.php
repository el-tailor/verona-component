<?php

namespace Verona\Component\HttpFoundation\Files;

final class UploadFile {

    private array $files;

    private function __construct()
    {
        $this->files = isset($_FILES) ? $_FILES : null;
        unset($_FILES);
    }

    public static function getInstance() : ?UploadFile {
        if (isset($_FILES)) return new UploadFile();
        return null;
    }

}