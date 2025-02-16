<?php

namespace Verona\Component\Console;

use Verona\Component\Console\Command\CacheCommand;
use Verona\Component\Console\Command\Controller\MakeControllerCommand;
use Verona\Component\Console\Command\RoutingCommand;
use Verona\Component\Console\Command\ServerCommand;

final class Application
{

    public function __construct(private array $arguments, string $basePath)
    {
        define('BASE_PATH', $basePath);
        $this->init();
    }

    private function init()
    {
        if (count($this->arguments) > 1) {
            $initial_command = $this->arguments[1];
            $command = match ($initial_command) {
                "server:start" => new ServerCommand(),
                "create:controller" => new MakeControllerCommand(),
                "dump:routes" => new RoutingCommand(),
                "cache:clear" => new CacheCommand(),
                default => null
            };
            $command?->start($this->arguments);
            if ($command == null) Console::writeLine("Commande invalide", Console::COLOR_WHITE, Console::BACKGROUND_COLOR_RED);
            exit;
        }
        Console::writeLine("Veuillez insérer une commande à exécuter", Console::COLOR_WHITE, Console::BACKGROUND_COLOR_RED);
    }
}
