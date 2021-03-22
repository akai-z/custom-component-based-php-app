<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\App;

use CustomComponentApp\Framework\App\ModeInterface;
use CustomComponentApp\Framework\Di\Container\Definition\Config as DefinitionConfig;
use CustomComponentApp\Framework\Di\Container\DefinitionInterface;
use DI\ContainerBuilder;

use function Di\autowire;

class Bootstrap
{
    private string $appModeClass;

    public function __construct(string $appModeClass)
    {
        $this->appModeClass = $appModeClass;
    }

    public function prepare(): ModeInterface
    {
        $diContainerDefinitionBuilder = new ContainerBuilder();
        $appModeDiContainerDefinition = [ModeInterface::class => autowire($this->appModeClass)];

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
    }
}
