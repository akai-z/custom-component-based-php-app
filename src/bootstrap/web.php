<?php

declare(strict_types=1);

use CustomComponentApp\Framework\App\Bootstrap;
use CustomComponentApp\Framework\App\Mode\Web as WebMode;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

return (new Bootstrap(WebMode::class))->prepare();
