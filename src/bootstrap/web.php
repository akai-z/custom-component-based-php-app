<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use CustomComponentApp\Framework\App\ModeInterface;
use CustomComponentApp\Framework\App\Mode\Web as WebMode;
use CustomComponentApp\Framework\Di\Container\Definition\Config as DefinitionConfig;
use CustomComponentApp\Framework\Di\Container\DefinitionInterface;

use function Di\autowire;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

$diContainerDefinitionBuilder = new ContainerBuilder();
$diContainerDefinitionBuilder->addDefinitions(
    [
        DefinitionInterface::class => autowire(DefinitionConfig::class),
        ModeInterface::class => autowire(WebMode::class)
    ]
);

$diContainerDefinitionConfig = $diContainerDefinitionBuilder->build();
$diContainerDefinitions = $diContainerDefinitionConfig->get(DefinitionInterface::class);

return $diContainerDefinitionConfig->make(
    ModeInterface::class,
    ['diContainerDefinitions' => $diContainerDefinitions->definitions()]
);
