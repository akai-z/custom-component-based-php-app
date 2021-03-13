<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Serialize;

interface SerializerInterface
{
    /**
     * @throws \InvalidArgumentException
     */
    public function serialize(array $data): string;

    /**
     * @throws \InvalidArgumentException
     */
    public function unserialize(string $string): array;
}
