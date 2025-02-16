<?php

namespace Verona\Component\IO;

class File
{

    public function __construct(private string $filepath = __DIR__) {}

    public function isDirectory(): bool
    {
        return is_dir($this->filepath);
    }

    public function isFile(): bool
    {
        return is_file($this->filepath);
    }

    public function delete(bool $self = true)
    {
        $this->deleteAll($this->filepath);
        if(!$self) mkdir($this->filepath);
    }

    private function deleteAll(string $dir)
    {
        if ($this->isFile()) unlink($dir);
        else {
            $files = array_diff(scandir($dir), array('.', '..'));
            foreach ($files as $tmp) {
                $file = $dir . $tmp;
                if (is_file($file)) unlink($file);
                else $this->deleteAll($file);
            }
            rmdir($dir);
        }
    }
}
