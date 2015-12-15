<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\AvailabilityCheckoutConnector\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationDependencyContainer;
use Spryker\Zed\AvailabilityCheckoutConnector\AvailabilityCheckoutConnectorDependencyProvider;
use Spryker\Zed\AvailabilityCheckoutConnector\Dependency\Facade\AvailabilityToCheckoutConnectorFacadeInterface as AvailabilityFacade;

class AvailabilityCheckoutConnectorDependencyContainer extends AbstractCommunicationDependencyContainer
{

    /**
     * @return AvailabilityFacade
     */
    public function getAvailabilityFacade()
    {
        return $this->getProvidedDependency(AvailabilityCheckoutConnectorDependencyProvider::FACADE_AVAILABILITY);
    }

}
