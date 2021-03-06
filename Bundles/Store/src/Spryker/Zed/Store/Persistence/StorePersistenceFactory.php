<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Store\Persistence;

use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Spryker\Zed\Store\StoreConfig getConfig()
 * @method \Spryker\Zed\Store\Persistence\StoreQueryContainerInterface getQueryContainer()
 */
class StorePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Store\Persistence\SpyStoreQuery
     */
    public function createStoreQuery()
    {
        return SpyStoreQuery::create();
    }
}
