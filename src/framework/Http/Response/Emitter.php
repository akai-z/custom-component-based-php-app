<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Response;

use CustomComponentApp\Framework\Http\Response\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface as LaminasEmitterInterface;
use Psr\Http\Message\ResponseInterface;

class Emitter implements EmitterInterface
{
    private LaminasEmitterInterface $sapiEmitter;

    public function __construct(LaminasEmitterInterface $sapiEmitter)
    {
        $this->sapiEmitter = $sapiEmitter;
    }

    public function emit(ResponseInterface $response): void
    {
        $this->sapiEmitter->emit($response);
    }
}
