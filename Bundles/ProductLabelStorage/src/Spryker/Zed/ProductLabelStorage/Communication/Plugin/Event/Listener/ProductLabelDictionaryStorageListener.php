<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductLabelStorage\Communication\Plugin\Event\Listener;

use Spryker\Zed\Event\Dependency\Plugin\EventBulkHandlerInterface;
use Spryker\Zed\ProductLabel\Dependency\ProductLabelEvents;
use Spryker\Zed\ProductLabel\Persistence\Propel\SpyProductLabelQuery;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

/**
 * @method \Spryker\Zed\ProductLabelStorage\Persistence\ProductLabelStorageQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\ProductLabelStorage\Communication\ProductLabelStorageCommunicationFactory getFactory()
 */
class ProductLabelDictionaryStorageListener extends AbstractProductLabelDictionaryStorageListener implements EventBulkHandlerInterface
{
    use DatabaseTransactionHandlerTrait;

    /**
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface[] $eventTransfers
     * @param string $eventName
     *
     * @return void
     */
    public function handleBulk(array $eventTransfers, $eventName)
    {
        $this->preventTransaction();
        $productLabelsCount = SpyProductLabelQuery::create()->count();

        if (($eventName === ProductLabelEvents::ENTITY_SPY_PRODUCT_LABEL_DELETE || $eventName === ProductLabelEvents::PRODUCT_LABEL_DICTIONARY_UNPUBLISH) &&
            $productLabelsCount === 0
        ) {
            $this->unpublish();
        } else {
            $this->publish();
        }
    }
}
