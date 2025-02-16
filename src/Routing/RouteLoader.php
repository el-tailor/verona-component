<?php

namespace Verona\Component\Routing;

use Exception;
use Verona\Component\Console\Console;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;

class RouteLoader
{

    private string $controller_path;

    public function __construct(private string $config_path)
    {
        //$this->config_path = dirname(dirname(__DIR__)) . "/config/routes.php";
        $this->controller_path = BASE_PATH . "/src/Controller\\";
    }

    public function reload()
    {
        $controllers = $this->retrieveController();
        $namespaces = $this->retrieveNamespace($controllers);
        $routes = $this->retrieveAttribute($namespaces);
        $this->generateRoutes($routes);
    }

    private function  retrieveController(): array
    {
        $controller = [];
        try {
            $recursives = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($this->controller_path));
            foreach ($recursives as $file) {
                if ($file->isFile())
                    $controller[] = $file->getPathName();
            }
        }catch(Exception $e) {
            
        }
        return $controller;
    }

    private function retrieveNamespace(array $files): array
    {
        $namespaces = [];
        foreach ($files as $file) {
            $tmp = "App\\Controller\\" . str_ireplace($this->controller_path, "", $file);
            $temp = str_replace(".php", "", $tmp);
            $namespaces[] = $temp;
            //echo $temp . "\n";
        }
        return $namespaces;
    }

    private function retrieveAttribute(array $namespaces)
    {
        $routes = [];
        foreach ($namespaces as $namespace) {
            $reflexion = new ReflectionClass($namespace);
            $attrs = $reflexion->getAttributes()[0];
            $route = $attrs->newInstance();
            $route->controller = $namespace;
            $routes[] = $route;
        }
        //echo var_dump($routes);
        return $routes;
    }

    private function generateRoutes(array $routes)
    {
        if (!empty($routes)) {
            touch($this->config_path);
            $content = "<?php\n\n";
            $content .= "const routes = array(\n";
            foreach ($routes as $index => $route) {
                $content .= "\t[";
                $content .= "'path' => '" . $route->path . "', ";
                $content .= "'name' => '" . $route->name . "', ";
                $content .= "'controller' => '" . $route->controller . "']";
                if ($index < count($routes) - 1) $content .= ",";
                $content .= "\n";
            }
            $content .= ");";
            file_put_contents($this->config_path, $content);
        }
        Console::writeLine("[OK] Routes générées", Console::COLOR_WHITE, Console::BACKGROUND_COLOR_GREEN);
    }
}
