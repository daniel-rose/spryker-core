<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\ProductOptionStorage\Dependency\Service;

class ProductOptionStorageToSynchronizationServiceBridge implements ProductOptionStorageToSynchronizationServiceInterface
{
    /**
     * @var \Spryker\Service\Synchronization\SynchronizationServiceInterface
     */
    protected $synchronizationService;

    /**
     * CmsToSynchronizationServiceBridge constructor.
     *
     * @param \Spryker\Service\Synchronization\SynchronizationServiceInterface $synchronizationService
     */
    public function __construct($synchronizationService)
    {
        $this->synchronizationService = $synchronizationService;
    }

    /**
     * @param string $resourceName
     *
     * @return \Spryker\Service\Synchronization\Dependency\Plugin\SynchronizationKeyGeneratorPluginInterface
     */
    public function getStorageKeyBuilder($resourceName)
    {
        return $this->synchronizationService->getStorageKeyBuilder($resourceName);
    }
}
