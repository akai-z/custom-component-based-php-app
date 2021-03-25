<?php

declare(strict_types=1);

namespace CustomComponentApp\App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FooBar extends Command
{
    /**
     * @inheritDoc
     */
    protected static $defaultName = 'app:foobar';

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this
            ->setDescription('FooBar')
            ->addArgument('bar', InputArgument::OPTIONAL, 'Bar');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $bar = $input->getArgument('bar') ?: 'bar';
        $output->writeln('foo ' . $bar);

        return Command::SUCCESS;
    }
}
