<?php

namespace Verona\Component\Console\Command;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Verona\Component\Console\Console;
use Verona\Component\IO\File;

class CacheCommand extends AbstractCommand {

    private string $cache;

    public function __construct()
    {
        $this->cache = BASE_PATH . "/var/cache/";
    }

    public function start(array $arguments = [])
    {
        Console::writeLine("\n// Nettoyage des caches\n");
        $file = new File($this->cache);
        $file->delete(true);
        Console::writeLine("[OK] caches supprimés", Console::COLOR_WHITE, Console::BACKGROUND_COLOR_GREEN);
        exec("php bin/console dump:routes");
    }
}