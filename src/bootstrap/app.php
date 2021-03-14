<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use CustomComponentApp\Framework\Di\Container\Definition\Config;
use CustomComponentApp\Framework\Di\Container\DefinitionInterface;
use CustomComponentApp\Framework\Http\Request\Processor as RequestProcessor;
use CustomComponentApp\Framework\Http\Response\EmitterInterface;
use CustomComponentApp\Framework\Http\Router\DispatcherRoutes;

use function Di\autowire;
use function FastRoute\simpleDispatcher;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$configDiContainerBuilder = new ContainerBuilder();

$configDiContainerBuilder->addDefinitions([DefinitionInterface::class => autowire(Config::class)]);
$configDiContainer = $configDiContainerBuilder->build();

$diContainerBuilder = new ContainerBuilder();
$diContainerDefinitionConfig = $configDiContainer->get(DefinitionInterface::class);
$diContainerBuilder->addDefinitions($diContainerDefinitionConfig->definitions());

$diContainer = $diContainerBuilder->build();

$requestProcessor = $diContainer->get(RequestProcessor::class);
$routeDispatcher = simpleDispatcher([$diContainer->get(DispatcherRoutes::class), 'setRoutes']);
$response = $requestProcessor->createResponse($routeDispatcher);

$emitter = $diContainer->get(EmitterInterface::class);
$emitter->emit($response);
