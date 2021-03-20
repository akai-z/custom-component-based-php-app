<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Config;

use CustomComponentApp\Framework\Config\Loader as ConfigLoader;
use CustomComponentApp\Framework\Serialize\Serializer\Yaml;
use Psr\Container\ContainerInterface;

class LoaderInstantiator
{
    private ContainerInterface $diContainer;
    private ?ConfigLoader $configLoader = null;

    public function __construct(ContainerInterface $diContainer)
    {
        $this->diContainer = $diContainer;
    }

    public function create(): ConfigLoader
    {
        return $this->diContainer->make(
            Loader::class,
            ['serializer' => $this->diContainer->get(Yaml::class)]
        );
    }

    public function get(): ConfigLoader
    {
        if ($this->configLoader === null) {
            $this->configLoader = $this->create();
        }

        return $this->configLoader;
    }
}
