<?php

declare(strict_types=1);

namespace CustomComponentApp\App\Routes;

use CustomComponentApp\Framework\Http\Router\RouteInterface;
use CustomComponentApp\Framework\Serialize\SerializerInterface;
use Fig\Http\Message\RequestMethodInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class FooBar implements RouteInterface
{
    const HTTP_METHODS = [RequestMethodInterface::METHOD_GET];
    const PATH = 'foobar';

    private SerializerInterface $serializer;
    private ResponseFactoryInterface $responseFactory;

    public function __construct(SerializerInterface $serializer, ResponseFactoryInterface $responseFactory)
    {
        $this->serializer = $serializer;
        $this->responseFactory = $responseFactory;
    }

    /**
     * @inheritDoc
     */
    public function httpMethods(): array
    {
        return self::HTTP_METHODS;
    }

    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return self::PATH;
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryParams = $request->getQueryParams();
        $bar = isset($queryParams['bar']) && $queryParams['bar'] !== '' ? $queryParams['bar'] : 'bar';

        $response = $this->responseFactory->createResponse();
        $response->getBody()->write($this->serializer->serialize(['foo' => $bar]));

        return $response->withHeader('Content-type', 'application/json; charset=utf-8');
    }
}
