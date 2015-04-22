<?php

namespace Functional\SprykerFeature\Zed\DiscountCalculationConnector\Business\Model\Calculator;

use Codeception\TestCase\Test;
use SprykerFeature\Shared\Calculation\Dependency\Transfer\TotalsInterface;
use SprykerEngine\Shared\Kernel\LocatorLocatorInterface;
use SprykerFeature\Shared\Sales\Transfer\Order;
use SprykerFeature\Shared\Sales\Transfer\OrderItem;
use SprykerFeature\Shared\Calculation\Transfer\Discount;
use SprykerFeature\Shared\Calculation\Transfer\Expense;
use SprykerFeature\Zed\Calculation\Business\Model\Calculator\GrandTotalTotalsCalculator;
use SprykerFeature\Zed\DiscountCalculationConnector\Business\Model\Calculator\DiscountTotalsCalculator;
use SprykerFeature\Zed\Calculation\Business\Model\Calculator\ExpenseTotalsCalculator;
use SprykerFeature\Zed\Calculation\Business\Model\Calculator\SubtotalTotalsCalculator;
use SprykerFeature\Zed\DiscountCalculationConnector\Business\Model\Calculator\GrandTotalWithDiscountsTotalsCalculator;
use SprykerEngine\Zed\Kernel\Locator;

/**
 * Class GrandTotalWithoutDiscountsTest
 * @group GrandTotalWithoutDiscountsTest
 * @group Calculation
 * @package PhpUnit\SprykerFeature\Zed\Calculation\Business\Model\Calculator
 */
class GrandTotalTest extends Test
{
    const ITEM_GROSS_PRICE = 10000;
    const ITEM_COUPON_DISCOUNT_AMOUNT = 1000;
    const ITEM_SALESRULE_DISCOUNT_AMOUNT = 1000;
    const ORDER_SHIPPING_COSTS = 2000;

    /**
     * @var LocatorLocatorInterface|\Generated\Zed\Ide\AutoCompletion
     */
    protected $locator;

    protected function setUp()
    {
        parent::setUp();
        $this->locator = Locator::getInstance();
    }

    public function testGrandTotalShouldBeZeroForAnEmptyOrder()
    {
        $order = $this->getOrderWithFixtureData();

        $totalsTransfer = $this->getPriceTotals();
        $calculator = $this->getGrandTotalCalculator();
        $calculator->recalculateTotals($totalsTransfer, $order, $order->getItems());
        $this->assertEquals(0, $totalsTransfer->getGrandTotalWithDiscounts());
    }

    public function testGrandTotalWithoutDiscountsShouldNotBeReducedByTheDiscounts()
    {
        $order = $this->getOrderWithFixtureData();

        $item = $this->getItemWithFixtureData();
        $item->setGrossPrice(self::ITEM_GROSS_PRICE);
        $order->addItem($item);

        $discount = $this->getPriceDiscount();
        $discount->setAmount(self::ITEM_SALESRULE_DISCOUNT_AMOUNT);
        $item->addDiscount($discount);

        $totalsTransfer = $this->getPriceTotals();
        $calculator = $this->getGrandTotalCalculator();
        $calculator->recalculateTotals($totalsTransfer, $order, $order->getItems());
        $this->assertEquals(self::ITEM_GROSS_PRICE, $totalsTransfer->getGrandTotal());
    }

    public function testGrandTotalWithoutDiscountsShouldBeByTheDiscountAmountReducedComparedToTheGrandTotal()
    {
        $order = $this->getOrderWithFixtureData();

        $item = $this->getItemWithFixtureData();
        $item->fillWithFixtureData();
        $item->setGrossPrice(self::ITEM_GROSS_PRICE);
        $order->addItem($item);

        $discount = $this->getPriceDiscount();
        $discount->setAmount(self::ITEM_SALESRULE_DISCOUNT_AMOUNT);
        $item->addDiscount($discount);

        $totalsTransfer = $this->getPriceTotals();
        $calculator = $this->getGrandTotalCalculator();
        $calculator->recalculateTotals($totalsTransfer, $order, $order->getItems());
        $calculator = $this->getGrandTotalWithDiscountCalculator();
        $calculator->recalculateTotals($totalsTransfer, $order, $order->getItems());
        $this->assertEquals(
            $totalsTransfer->getGrandTotal() - self::ITEM_SALESRULE_DISCOUNT_AMOUNT,
            $totalsTransfer->getGrandTotalWithDiscounts()
        );
    }

    /**
     * @return GrandTotalTotalsCalculator
     */
    private function getGrandTotalCalculator()
    {
        return new GrandTotalTotalsCalculator(
            $this->locator,
            new SubtotalTotalsCalculator($this->locator),
            new ExpenseTotalsCalculator($this->locator)
        );
    }

    /**
     * @return GrandTotalWithDiscountsTotalsCalculator
     */
    protected function getGrandTotalWithDiscountCalculator()
    {
        return new GrandTotalWithDiscountsTotalsCalculator(
            $this->locator,
            $this->locator->calculation()->facade(),
            new DiscountTotalsCalculator($this->locator)
        );
    }

    /**
     * @return TotalsInterface
     */
    protected function getPriceTotals()
    {
        return $this->locator->calculation()->transferTotals();
    }

    /**
     * @return Discount
     */
    protected function getPriceDiscount()
    {
        return $this->locator->calculation()->transferDiscount();
    }

    /**
     * @return Order
     */
    protected function getOrderWithFixtureData()
    {
        /* @var Order $order */
        $order = $this->locator->sales()->transferOrder();
        $order->fillWithFixtureData();

        return $order;
    }

    /**
     * @return OrderItem
     */
    protected function getItemWithFixtureData()
    {
        /* @var OrderItem $item */
        $item = $this->locator->sales()->transferOrderItem();
        $item->fillWithFixtureData();

        return $item;
    }

    /**
     * @return Expense
     */
    protected function getExpenseWithFixtureData()
    {
        /* @var Expense $expense */
        $expense = $this->locator->calculation()->transferExpense();
        $expense->fillWithFixtureData();

        return $expense;
    }
}
