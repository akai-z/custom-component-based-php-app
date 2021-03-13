<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Di\Container;

interface DefinitionInterface
{
    const CONFIG_PATH = 'di/container';

    public function definitions(): array;
}
