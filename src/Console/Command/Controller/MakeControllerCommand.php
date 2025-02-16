<?php 

namespace Verona\Component\Console\Command\Controller;

use Exception;
use Verona\Component\Console\Command\AbstractCommand;
use Verona\Component\Console\Console;

final class MakeControllerCommand extends AbstractCommand {

    public function start(array $arguments = [])
    {
        $namespace = "";
        if (count($arguments) > 2) $namespace = $arguments[2];
        while(!$this->checkNamespace($namespace)) {
            if (!empty($namespace)) Console::writeLine("Namespace invalide\n", Console::COLOR_WHITE, Console::BACKGROUND_COLOR_RED);
            $namespace = $this->retrieveNamespace();
        }
        new ControllerGenerator($namespace);
    }

    private function retrieveNamespace() : string {
        Console::write("Veuillez insérer le namespace de votre controller ex : ", Console::COLOR_GREEN);
        Console::writeLine("App\Controller\HomeController", Console::COLOR_YELLOW);
        Console::write("> ");
        return trim(fgets(STDIN));
    }

    private function checkNamespace(string $namespace) : bool {
        return str_starts_with($namespace, "App\\Controller\\");
    }

}
