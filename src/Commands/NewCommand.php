<?php

namespace MerakiCLI\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use MerakiCLI\Support\ProcessRunner;

class NewCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('new')
            ->setDescription('Create a new Meraki project')
            ->addArgument('name', InputArgument::REQUIRED, 'Application name')
            ->addArgument('path', InputArgument::OPTIONAL, 'Target path', '.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $path = rtrim($input->getArgument('path'), '/');

        $output->writeln("<info>Creating Meraki app:</info> {$name}");

        ProcessRunner::run([
            'composer',
            'create-project',
            'laravel/laravel',
            $name
        ], $path);

        $output->writeln("<comment>Installing Meraki...</comment>");

        ProcessRunner::run([
            'composer',
            'require',
            'merakilab/meraki'
        ], "{$path}/{$name}");

        $output->writeln("<info>Done.</info>");

        return Command::SUCCESS;
    }
}
