<?php

namespace Verona\Component\Console\Command\Controller;

use Verona\Component\Console\Console;

final class ControllerGenerator {

    private ?string $filepath = null;
    private ?string $templatePath = null;
    private ?string $template = null;
    private ?string $className = null;

    public function __construct(private string $namespace)
    {
        $this->filepath = BASE_PATH . "/" . str_replace("App", "src", $this->namespace) . ".php";
        $this->className = substr($this->namespace, strrpos($this->namespace, "\\")+1);
        $this->template = strtolower(str_replace("Controller", "", $this->className)) . "/index.php";
        $this->templatePath = BASE_PATH . "/templates/" . $this->template;
        $this->init();
    }

    private function init() {
        $dir = dirname($this->filepath);
        $tempDir = dirname($this->templatePath);
        if (!is_dir($dir)) mkdir($dir, 0777, true);
        if (!is_dir($tempDir)) mkdir($tempDir, 0777, true);
        touch($this->filepath);
        touch($this->templatePath);
        $this->generate();
    }

    private function generate() {
        $temp = file_get_contents(__DIR__ . "/TmpController");
        $temp = str_replace("[namespace]", str_replace("\\".$this->className, "", $this->namespace), $temp);
        $temp = str_replace("[class]", $this->className, $temp);
        $temp = str_replace("[template]", $this->template, $temp);
        $temp = str_replace("[url]", str_replace("/index.php", "", $this->template), $temp);
        $temp = str_replace("[name]", "app_" . strtolower(str_replace("Controller", "", $this->className)), $temp);
        file_put_contents($this->filepath, "<?php" .$temp);
        $this->generateTemplate();
    }

    private function generateTemplate() {
        $content = file_get_contents(__DIR__ . "/TmpTemplate");
        file_put_contents($this->templatePath, $content);
        $this->finalize();
    }

    private function finalize() {
        Console::write("Controleur créer : ");
        Console::writeLine(str_replace("App", "src", $this->namespace) . ".php", Console::COLOR_BLUE);
        Console::write("Template Crée : ");
        Console::writeLine($this->template, Console::COLOR_BLUE);
        exec("php bin/console dump:routes");
    }

}