<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Router;

use Psr\Http\Server\RequestHandlerInterface;

interface RouteInterface extends RequestHandlerInterface
{
    public function httpMethods(): array;

    /**
     * Route path.
     */
    public function path(): string;
}
