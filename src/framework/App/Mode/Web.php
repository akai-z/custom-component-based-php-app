<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\App\Mode;

use CustomComponentApp\Framework\App\ModeInterface;
use CustomComponentApp\Framework\Http\Request\Processor as RequestProcessor;
use CustomComponentApp\Framework\Http\Response\EmitterInterface;
use CustomComponentApp\Framework\Http\Router\DispatcherRoutes;

use function FastRoute\simpleDispatcher;

class Web implements ModeInterface
{
    const CODE = 'web';

    private RequestProcessor $requestProcessor;
    private EmitterInterface $emitter;
    private DispatcherRoutes $dispatcherRoutes;

    public function __construct(
        RequestProcessor $requestProcessor,
        EmitterInterface $emitter,
        DispatcherRoutes $dispatcherRoutes
    ) {
        $this->requestProcessor = $requestProcessor;
        $this->emitter = $emitter;
        $this->dispatcherRoutes = $dispatcherRoutes;
    }

    public function code(): string
    {
        return self::CODE;
    }

    public function run(): void
    {
        $routeDispatcher = simpleDispatcher([$this->dispatcherRoutes, 'setRoutes']);
        $response = $this->requestProcessor->createResponse($routeDispatcher);

        $this->emitter->emit($response);
    }
}
