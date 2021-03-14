<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Di\Container\Definition\Type;

use CustomComponentApp\Framework\Config\Loader as ConfigLoader;
use CustomComponentApp\Framework\Di\Container\DefinitionInterface;

use function Di\autowire;

class Wiring implements DefinitionInterface
{
    const DEFINITIONS_FILE = 'wiring';

    private ConfigLoader $config;

    public function __construct(ConfigLoader $config)
    {
        $this->config = $config;
    }

    public function definitions(): array
    {
        $file = self::CONFIG_PATH . '/' . self::DEFINITIONS_FILE;
        $definitions = $this->config->data($file);

        foreach ($definitions as $abstraction => $concretion) {
            $definitions[$abstraction] = autowire($concretion);
        }

        return $definitions;
    }
}
