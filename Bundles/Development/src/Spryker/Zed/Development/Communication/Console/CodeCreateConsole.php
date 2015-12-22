<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Development\Communication\Console;

use Spryker\Zed\Console\Business\Model\Console;
use Spryker\Zed\Development\Business\DevelopmentFacade;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method DevelopmentFacade getFacade()
 */
class CodeCreateConsole extends Console
{

    const COMMAND_NAME = 'code:create:bridge';
    const OPTION_BUNDLE = 'from bundle';
    const OPTION_TO_BUNDLE = 'to bundle';

    /**
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME)
            ->setHelp('<info>' . self::COMMAND_NAME . ' -h</info>')
            ->setDescription('Create bridge and facade interface.');

        $this->addArgument(self::OPTION_BUNDLE, InputArgument::REQUIRED, 'Name of core bundle where the bridge should be created in.');
        $this->addArgument(self::OPTION_TO_BUNDLE, InputArgument::REQUIRED, 'Name of core bundle to which the bundle must be connected to.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @throws \Exception
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $bundle = $this->input->getArgument(self::OPTION_BUNDLE);
        $toBundle = $this->input->getArgument(self::OPTION_TO_BUNDLE);

        $message = 'Create bridge in ' . $bundle;

        $this->info($message);

        $this->getFacade()->createBridge($bundle, $toBundle);
    }

}