<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductOption\Business\OptionGroup;

use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ProductOptionTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItemOption;
use Spryker\Zed\ProductOption\Persistence\ProductOptionQueryContainerInterface;

class ProductOptionOrderHydrate implements ProductOptionOrderHydrateInterface
{
    /**
     * @var \Spryker\Zed\ProductOption\Persistence\ProductOptionQueryContainerInterface
     */
    protected $productOptionQueryContainer;

    /**
     * @param \Spryker\Zed\ProductOption\Persistence\ProductOptionQueryContainerInterface $productOptionQueryContainer
     */
    public function __construct(ProductOptionQueryContainerInterface $productOptionQueryContainer)
    {
        $this->productOptionQueryContainer = $productOptionQueryContainer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function hydrate(OrderTransfer $orderTransfer)
    {
        $orderTransfer->requireIdSalesOrder();

        $salesOrderItems = $this->getSalesOrderItemsByIdSalesOrder($orderTransfer->getIdSalesOrder());

        foreach ($salesOrderItems as $salesOrderItemEntity) {
            $itemTransfer = $this->findItemTransferOptionsBelongTo(
                $orderTransfer,
                $salesOrderItemEntity->getIdSalesOrderItem()
            );

            if ($itemTransfer === null) {
                continue;
            }

            $itemTransfer->setUnitProductOptionPriceAggregation($salesOrderItemEntity->getProductOptionPriceAggregation());

            foreach ($salesOrderItemEntity->getOptions() as $orderItemOptionEntity) {
                $productOptionsTransfer = $this->hydrateProductOptionTransfer($orderItemOptionEntity);
                $itemTransfer->addProductOption($productOptionsTransfer);
            }
        }

        return $orderTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\ItemTransfer|null
     */
    protected function findItemTransferOptionsBelongTo(OrderTransfer $orderTransfer, $idSalesOrderItem)
    {
        foreach ($orderTransfer->getItems() as $itemTransfer) {
            if ($itemTransfer->getIdSalesOrderItem() === $idSalesOrderItem) {
                return $itemTransfer;
            }
        }

        return null;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItemOption $orderItemOptionEntity
     *
     * @return \Generated\Shared\Transfer\ProductOptionTransfer
     */
    protected function hydrateProductOptionTransfer(SpySalesOrderItemOption $orderItemOptionEntity)
    {
        $productOptionsTransfer = new ProductOptionTransfer();
        $productOptionsTransfer->setQuantity(1);
        $productOptionsTransfer->setUnitPrice($orderItemOptionEntity->getPrice());
        $productOptionsTransfer->setUnitGrossPrice($orderItemOptionEntity->getGrossPrice());
        $productOptionsTransfer->setUnitNetPrice($orderItemOptionEntity->getNetPrice());
        $productOptionsTransfer->setUnitDiscountAmountAggregation($orderItemOptionEntity->getDiscountAmountAggregation());
        $productOptionsTransfer->setUnitTaxAmount($orderItemOptionEntity->getTaxAmount());

        $productOptionsTransfer->fromArray($orderItemOptionEntity->toArray(), true);

        return $productOptionsTransfer;
    }

    /**
     * @param int $idSalesOrder
     *
     * @return \Orm\Zed\Sales\Persistence\SpySalesOrderItem[]|\Propel\Runtime\Collection\ObjectCollection
     */
    protected function getSalesOrderItemsByIdSalesOrder($idSalesOrder)
    {
        return $this->productOptionQueryContainer
            ->querySalesOrder()
            ->filterByFkSalesOrder($idSalesOrder)
            ->find();
    }
}
