<?php

namespace Verona\Component\Console\Command;

final class ServerCommand extends AbstractCommand
{

    public function start(array $arguments = [])
    {
        $port = 8000;
        foreach ($arguments as $index => $value) {
            if ($index > 1) {
                $parts = preg_split("#=#", $value);
                if (trim($parts[0]) === '--port') $port = trim($parts[1]);
            }
        }
        exec("php -S localhost:$port -t public/ public/index.php");
    }
}
