<?php

declare(strict_types=1);

use CustomComponentApp\Framework\App\Mode\Web as WebMode;
use CustomComponentApp\Framework\App\ModeInterface;
use CustomComponentApp\Framework\Di\Container\Definition\Config as DefinitionConfig;
use CustomComponentApp\Framework\Di\Container\DefinitionInterface;
use DI\ContainerBuilder;

use function Di\autowire;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$diContainerDefinitionBuilder = new ContainerBuilder();
$appModeDiContainerDefinition = [ModeInterface::class => autowire(WebMode::class)];

$diContainerDefinitionBuilder
    ->addDefinitions([DefinitionInterface::class => autowire(DefinitionConfig::class)])
    ->addDefinitions($appModeDiContainerDefinition);

$diContainerDefinitionConfig = $diContainerDefinitionBuilder->build();
$diContainerDefinitions = $diContainerDefinitionConfig->get(DefinitionInterface::class);

$appDiContainerBuilder = new ContainerBuilder();

$appDiContainerBuilder
    ->addDefinitions($diContainerDefinitions->definitions())
    ->addDefinitions($appModeDiContainerDefinition);

$appDiContainer = $appDiContainerBuilder->build();

return $appDiContainer->make(ModeInterface::class);
