<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Di\Container\Definition;

use CustomComponentApp\Framework\ClassGroup\Loader as ClassGroupLoader;
use CustomComponentApp\Framework\Config\LoaderFactory as ConfigLoaderFactory;
use CustomComponentApp\Framework\Di\Container\Definition\Type;
use CustomComponentApp\Framework\Di\Container\DefinitionInterface;

class Config implements DefinitionInterface
{
    const DEFENITION_TYPES_DIR = 'framework/Di/Container/Definition/Type';

    private ClassGroupLoader $classLoader;
    private ConfigLoaderFactory $configLoaderFactory;

    public function __construct(ClassGroupLoader $classLoader, ConfigLoaderFactory $configLoaderFactory)
    {
        $this->classLoader = $classLoader;
        $this->configLoaderFactory = $configLoaderFactory;
    }

    public function definitions(): array
    {
        $definitions = [];
        $definitionsLoader = $this->classLoader->loadClass(
            self::DEFENITION_TYPES_DIR,
            Type::class,
            ['config' => $this->configLoaderFactory->create()]
        );

        foreach ($definitionsLoader as $definition) {
            $definitions[] = $definition->definitions();
        }

        return array_merge([], ...$definitions);
    }
}
