<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Serialize\Serializer;

use CustomComponentApp\Framework\Serialize\SerializerInterface;
use InvalidArgumentException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as YamlComponent;

class Yaml implements SerializerInterface
{
    /**
     * {@inheritDoc}
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function serialize(array $data): string
    {
        return YamlComponent::dump($data);
    }

    /**
     * {@inheritDoc}
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function unserialize(string $string): array
    {
        try {
            return YamlComponent::parse($string);
        } catch (ParseException $exception) {
            throw new InvalidArgumentException(
                sprintf('Unable to parse the YAML string: %s', $exception->getMessage())
            );
        }
    }
}
