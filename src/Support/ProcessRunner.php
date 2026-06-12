<?php

namespace MerakiCLI\Support;

use Symfony\Component\Process\Process;

class ProcessRunner
{
    public static function run(array $command, string $cwd): void
    {
        $process = new Process($command, $cwd);
        $process->setTty(Process::isTtySupported());
        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
    }
}
