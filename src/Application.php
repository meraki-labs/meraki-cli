<?php

namespace MerakiCLI;

use Symfony\Component\Console\Application as SymfonyApplication;
use MerakiCLI\Commands\NewCommand;
use MerakiCLI\Commands\InstallCommand;
use MerakiCLI\Commands\UpgradeCommand;

class Application extends SymfonyApplication
{
    public function __construct()
    {
        parent::__construct('Meraki CLI', '1.0.0');

        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        $this->add(new NewCommand());
        $this->add(new InstallCommand());
        $this->add(new UpgradeCommand());
    }
}
