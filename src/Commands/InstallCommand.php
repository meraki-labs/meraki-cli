<?php

namespace MerakiCLI\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MerakiCLI\Support\ProcessRunner;

class InstallCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('install')
            ->setDescription('Install Meraki into existing Laravel app');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Installing Meraki...</info>');

        ProcessRunner::run([
            'composer',
            'require',
            'merakilab/meraki-core'
        ], getcwd());

        return Command::SUCCESS;
    }
}
