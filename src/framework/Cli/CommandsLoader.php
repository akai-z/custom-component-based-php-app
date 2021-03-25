<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Cli;

use CustomComponentApp\App\Command;
use CustomComponentApp\Framework\ClassGroup\Loader as ClassGroupLoader;
use Symfony\Component\Console\Application as ConsoleApp;

class CommandsLoader
{
    const COMMANDS_DIR = 'app/Command';

    private ClassGroupLoader $classLoader;

    public function __construct(ClassGroupLoader $classLoader)
    {
        $this->classLoader = $classLoader;
    }

    public function setCommands(ConsoleApp $consoleApp): void
    {
        $commandsLoader = $this->classLoader->loadClass(self::COMMANDS_DIR, Command::class);

        foreach ($commandsLoader as $command) {
            $consoleApp->add($command);
        }
    }
}
