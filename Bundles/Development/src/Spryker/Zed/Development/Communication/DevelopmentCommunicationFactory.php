<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Development\Communication;

use Spryker\Zed\Development\Communication\Form\BundlesFormType;
use Spryker\Zed\Development\Communication\Form\DataProvider\BundleFormDataProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\Development\DevelopmentConfig getConfig()
 * @method \Spryker\Zed\Development\Business\DevelopmentFacadeInterface getFacade()
 */
class DevelopmentCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @param array $data
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createBundlesForm(array $data = [], array $options = [])
    {
        return $this->getFormFactory()->create(BundlesFormType::class, $data, $options);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $module
     *
     * @return \Spryker\Zed\Development\Communication\Form\DataProvider\BundleFormDataProvider
     */
    public function createBundleFormDataProvider(Request $request, $module)
    {
        $bundleFormDataProvider = new BundleFormDataProvider(
            $request,
            $this->getFacade()->showOutgoingDependenciesForModule($module)
        );

        return $bundleFormDataProvider;
    }
}
