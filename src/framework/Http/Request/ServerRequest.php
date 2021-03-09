<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Request;

use CustomComponentApp\Framework\Http\Request\ServerRequestInterface;
use Laminas\Diactoros\ServerRequestFactory;
use Psr\Http\Message\ServerRequestInterface as PsrServerRequestInterface;

class ServerRequest implements ServerRequestInterface
{
    public function globals(): PsrServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }
}
