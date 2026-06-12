<?php

namespace MerakiCLI\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MerakiCLI\Support\ProcessRunner;

class UpgradeCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('upgrade')
            ->setDescription('Upgrade Meraki into existing Laravel app')
            ->addArgument('version', InputArgument::REQUIRED, 'Target version');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $version = $input->getArgument('version');

        $output->writeln("<info>Switching Meraki to version {$version}</info>");

        ProcessRunner::run([
            'composer',
            'require',
            "merakilab/meraki:{$version}"
        ], getcwd());

        return Command::SUCCESS;
    }
}
