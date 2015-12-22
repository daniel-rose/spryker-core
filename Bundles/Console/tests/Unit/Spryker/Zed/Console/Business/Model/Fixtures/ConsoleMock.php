<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Zed\Console\Business\Model\Fixtures;

use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;
use Spryker\Zed\Console\Business\Model\Console;

class ConsoleMock extends Console
{

    /**
     * @return AbstractCommunicationFactory
     */
    public function getFactory()
    {
        return parent::getFactory();
    }

    /**
     * @return AbstractFacade
     */
    public function getFacade()
    {
        return parent::getFacade();
    }

    /**
     * @return AbstractQueryContainer
     */
    public function getQueryContainer()
    {
        return parent::getQueryContainer();
    }

}