<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\App\Mode;

use CustomComponentApp\Framework\App\ModeInterface;
use CustomComponentApp\Framework\Http\Request\Processor as RequestProcessor;
use CustomComponentApp\Framework\Http\Response\EmitterInterface;
use CustomComponentApp\Framework\Http\Router\DispatcherRoutes;
use DI\ContainerBuilder;

use function FastRoute\simpleDispatcher;

class Web implements ModeInterface
{
    const CODE = 'web';

    private array $diContainerDefinitions;

    public function __construct(array $diContainerDefinitions = [])
    {
        $this->diContainerDefinitions = $diContainerDefinitions;
    }

    public function code(): string
    {
        return self::CODE;
    }

    public function run(): void
    {
        $diContainerBuilder = new ContainerBuilder();
        $diContainerBuilder->addDefinitions($this->diContainerDefinitions);

        $diContainer = $diContainerBuilder->build();

        $requestProcessor = $diContainer->get(RequestProcessor::class);
        $routeDispatcher = simpleDispatcher([$diContainer->get(DispatcherRoutes::class), 'setRoutes']);
        $response = $requestProcessor->createResponse($routeDispatcher);

        $emitter = $diContainer->get(EmitterInterface::class);
        $emitter->emit($response);
    }
}
