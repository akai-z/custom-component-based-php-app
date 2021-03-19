<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\App;

interface ModeInterface
{
    public function code(): string;
    public function run(): void;
}
