<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Router;

use CustomComponentApp\App\Routes;
use CustomComponentApp\Framework\ClassGroup\Loader as ClassGroupLoader;
use FastRoute\RouteCollector;

class DispatcherRoutes
{
    const ROUTES_DIR = 'app/Routes';

    private ClassGroupLoader $classLoader;

    public function __construct(ClassGroupLoader $classLoader)
    {
        $this->classLoader = $classLoader;
    }

    public function setRoutes(RouteCollector $routeCollector): void
    {
        $routesLoader = $this->classLoader->loadClass(self::ROUTES_DIR, Routes::class);

        foreach ($routesLoader as $route) {
            $routeCollector->addRoute($route->httpMethods(), '/' . $route->path(), $route);
        }
    }
}
