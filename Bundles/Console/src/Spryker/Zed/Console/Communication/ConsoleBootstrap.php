<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Console\Communication;

use Spryker\Zed\Console\Business\ConsoleFacade;
use Spryker\Zed\Console\Business\Model\Environment;
use Spryker\Zed\Kernel\ClassResolver\Facade\FacadeNotFoundException;
use Spryker\Zed\Kernel\ClassResolver\Facade\FacadeResolver;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleBootstrap extends Application
{

    /**
     * @var ConsoleFacade
     */
    private $facade;

    /**
     * @param string $name
     * @param string $version
     */
    public function __construct($name = 'Spryker', $version = '1')
    {
        Environment::initialize();

        parent::__construct($name, $version);
        $this->setCatchExceptions(false);
    }

    /**
     * @return Command[]
     */
    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();

        $locatedCommands = $this->getFacade()->getConsoleCommands();

        foreach ($locatedCommands as $command) {
            $commands[$command->getName()] = $command;
        }

        return $commands;
    }

    /**
     * @return ConsoleFacade
     */
    protected function getFacade()
    {
        if ($this->facade === null) {
            $this->facade = $this->resolveFacade();
        }

        return $this->facade;
    }

    /**
     * @throws FacadeNotFoundException
     *
     * @return ConsoleFacade
     */
    protected function resolveFacade()
    {
        return $this->getFacadeResolver()->resolve($this);
    }

    /**
     * @return FacadeResolver
     */
    protected function getFacadeResolver()
    {
        return new FacadeResolver();
    }

    /*
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->getInfoText());

        return parent::doRun($input, $output);
    }

    /**
     * @return string
     */
    private function getInfoText()
    {
        return sprintf(
            '<fg=yellow>Store</fg=yellow>: <info>%s</info> | <fg=yellow>Environment</fg=yellow>: <info>%s</info>',
            APPLICATION_STORE,
            APPLICATION_ENV
        );
    }

}