<?php

namespace SprykerFeature\Zed\DiscountCalculationConnector\Business;

use SprykerFeature\Shared\Calculation\Dependency\Transfer\TotalsInterface;
use SprykerFeature\Shared\Discount\Dependency\Transfer\DiscountableItemCollectionInterface;
use SprykerFeature\Shared\Discount\Dependency\Transfer\DiscountableContainerInterface;
use SprykerEngine\Zed\Kernel\Business\AbstractFacade;

/**
 * @method DiscountCalculationConnectorDependencyContainer getDependencyContainer()
 */
class DiscountCalculationConnectorFacade extends AbstractFacade
{

    /**
     * @param TotalsInterface $totalsTransfer
     * @param DiscountableContainerInterface $discountableContainer
     * @param DiscountableItemCollectionInterface $discountableContainers
     */
    public function recalculateDiscountTotals(
        TotalsInterface $totalsTransfer,
        DiscountableContainerInterface $discountableContainer,
        DiscountableItemCollectionInterface $discountableContainers
    ) {
        $calculator = $this->getDependencyContainer()->getDiscountTotalsCalculator();
        $calculator->recalculateTotals($totalsTransfer, $discountableContainer, $discountableContainers);
    }

    /**
     * @param TotalsInterface $totalsTransfer
     * @param DiscountableContainerInterface $container
     * @param DiscountableItemCollectionInterface $items
     */
    public function recalculateGrandTotalWithDiscountsTotals(
        TotalsInterface $totalsTransfer,
        DiscountableContainerInterface $container,
        DiscountableItemCollectionInterface $items
    ) {
        $calculator = $this->getDependencyContainer()->getGrandTotalWithDiscountsTotalsCalculator();
        $calculator->recalculateTotals($totalsTransfer, $container, $items);
    }

    /**
     * @param DiscountableContainerInterface $container
     */
    public function recalculateRemoveAllCalculatedDiscounts(DiscountableContainerInterface $container)
    {
        $calculator = $this->getDependencyContainer()->getRemoveAllCalculatedDiscountsCalculator();
        $calculator->recalculate($container);
    }
}
