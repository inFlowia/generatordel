<?php

namespace App\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MiniCheckCommand extends Command
{
    /** {@inheritdoc} */
    protected function configure(): void
    {
        $this
            ->setName('gendel:mini_check')
            ->setDescription(
                'Minimal check of application functionality.'.PHP_EOL.
                '  Checks:'.PHP_EOL.
                '  - ability to clear Symfony cache;'.PHP_EOL.
                '  - ability to connect to the database.'.PHP_EOL
            )
            ;
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        if ($this->getApplication() === null) {
            throw new \UnexpectedValueException('Failed to get application');
        }

        ($this->getApplication()->find('cache:clear'))->run($input, $output);

        ($this->getApplication()->find('doctrine:migrations:status'))
            ->run($input, $output);

        $io = new SymfonyStyle($input, $output);

        $io->success(
            'Minimal check of application functionality has been success!'
        );

        return 0;
    }
}