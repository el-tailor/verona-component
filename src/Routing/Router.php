<?php 

namespace Verona\Component\Routing;

require_once BASE_PATH . "/var/cache/app_routes.php";

final class Router {

    public function getRoute(string $path): ?Route {
        foreach (routes as $route) {
            if ($route["path"] === $path) return new Route($route["path"], $route["name"], $route["controller"]);
        }
        return null;
    }

}
