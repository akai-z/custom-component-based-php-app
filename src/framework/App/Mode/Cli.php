<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\App\Mode;

use CustomComponentApp\Framework\App\ModeInterface;
use CustomComponentApp\Framework\Cli\CommandsLoader;
use Symfony\Component\Console\Application as ConsoleApp;

class Cli implements ModeInterface
{
    const CODE = 'cli';

    private CommandsLoader $commandsLoader;

    public function __construct(CommandsLoader $commandsLoader)
    {
        $this->commandsLoader = $commandsLoader;
    }

    public function code(): string
    {
        return self::CODE;
    }

    public function run(): void
    {
        $consoleApp = new ConsoleApp();
        $this->commandsLoader->setCommands($consoleApp);

        $consoleApp->run();
    }
}
