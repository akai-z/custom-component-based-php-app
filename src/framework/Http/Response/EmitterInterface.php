<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Response;

use Psr\Http\Message\ResponseInterface;

interface EmitterInterface
{
    public function emit(ResponseInterface $response): void;
}
