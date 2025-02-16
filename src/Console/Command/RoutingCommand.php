<?php

namespace Verona\Component\Console\Command;

use Verona\Component\Console\Command\AbstractCommand;
use Verona\Component\Console\Console;
use Verona\Component\Routing\RouteLoader;

class RoutingCommand extends AbstractCommand {

    private string $cache;

    public function __construct()
    {
        $this->cache = BASE_PATH . "/var/cache/app_routes.php";
    }

    public function start(array $arguments = [])
    {
        Console::writeLine("\n// Generate routes\n");
        $dir = dirname($this->cache);
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        //touch($this->cache);
        $loader = new RouteLoader($this->cache);
        $loader->reload();
    }

}