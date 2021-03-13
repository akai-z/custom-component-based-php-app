<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Config;

use CustomComponentApp\Framework\Config\FileReader;
use CustomComponentApp\Framework\Serialize\SerializerInterface;

class Loader
{
    private FileReader $fileReader;
    private SerializerInterface $serializer;

    public function __construct(FileReader $fileReader, SerializerInterface $serializer)
    {
        $this->fileReader = $fileReader;
        $this->serializer = $serializer;
    }

    public function data(string $file): array
    {
        return $this->serializer->unserialize($this->fileReader->read($file));
    }
}
