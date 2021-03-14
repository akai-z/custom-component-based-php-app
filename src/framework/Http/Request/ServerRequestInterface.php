<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Http\Request;

use Psr\Http\Message\ServerRequestInterface as PsrServerRequestInterface;

interface ServerRequestInterface
{
    public function globals(): PsrServerRequestInterface;
}
