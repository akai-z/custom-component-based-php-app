<?php

namespace CustomComponentApp\Framework\Serialize\Serializer;

use CustomComponentApp\Framework\Serialize\SerializerInterface;
use InvalidArgumentException;

class Json implements SerializerInterface
{
    /**
     * @inheritDoc
     */
    public function serialize(array $data): string
    {
        $result = json_encode($data);

        if ($result === false) {
            throw new InvalidArgumentException('Unable to serialize value. Error: ' . json_last_error_msg());
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function unserialize(string $string): array
    {
        $result = json_decode($string, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException(
                'Unable to unserialize value. Error: ' . json_last_error_msg()
            );
        }

        return $result;
    }
}
