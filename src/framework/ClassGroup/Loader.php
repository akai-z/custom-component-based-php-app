<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\ClassGroup;

use Generator;
use Psr\Container\ContainerInterface;

class Loader
{
    const PHP_FILE_EXTENSION = 'php';

    private ContainerInterface $diContainer;

    public function __construct(ContainerInterface $diContainer)
    {
        $this->diContainer = $diContainer;
    }

    public function loadClass(string $classFilesDir, string $namespace, array $classParams = []): Generator
    {
        foreach ($this->classFiles($classFilesDir) as $file) {
            $fileInfo = pathinfo($file);
            if (!$this->isPhpFile($fileInfo)) {
                continue;
            }

            $classFile = $namespace . '\\' . $fileInfo['filename'];

            yield !$classParams
                ? $this->diContainer->get($classFile)
                : $this->diContainer->make($classFile, $classParams);
        }
    }

    private function classFiles(string $classFilesDir): array
    {
        return scandir(dirname(dirname(__DIR__)) . '/' . $classFilesDir);
    }

    private function isPhpFile(array $fileInfo): bool
    {
        return $fileInfo['extension'] === self::PHP_FILE_EXTENSION;
    }
}
