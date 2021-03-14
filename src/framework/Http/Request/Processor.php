<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Request;

use CustomComponentApp\Framework\Http\Request\ServerRequestInterface;
use FastRoute\Dispatcher;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class Processor
{
    private ResponseFactoryInterface $responseFactory;

    public function __construct(
        ServerRequestInterface $serverRequest,
        ResponseFactoryInterface $responseFactory
    ) {
        $this->serverRequest = $serverRequest;
        $this->responseFactory = $responseFactory;
    }

    public function createResponse(Dispatcher $dispatcher): ResponseInterface
    {
        $request = $this->serverRequest->globals();
        $routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());

        if ($routeInfo[0] === Dispatcher::NOT_FOUND) {
            return $this->responseFactory->createResponse(StatusCodeInterface::STATUS_NOT_FOUND);
        }

        if ($routeInfo[0] === Dispatcher::METHOD_NOT_ALLOWED) {
            return $this->responseFactory->createResponse(StatusCodeInterface::STATUS_METHOD_NOT_ALLOWED)
                ->withHeader('Allow', implode(', ', $routeInfo[1]));
        }

        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        foreach ($vars as $name => $value) {
            $request = $request->withAttribute($name, $value);
        }

        return $handler->handle($request);
    }
}
