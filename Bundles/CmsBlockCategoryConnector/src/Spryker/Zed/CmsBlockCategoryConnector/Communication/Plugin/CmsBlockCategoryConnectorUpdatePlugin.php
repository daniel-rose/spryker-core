<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CmsBlockCategoryConnector\Communication\Plugin;

use Generated\Shared\Transfer\CmsBlockTransfer;
use Spryker\Zed\CmsBlock\Communication\Plugin\CmsBlockUpdatePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\CmsBlockCategoryConnector\Business\CmsBlockCategoryConnectorFacadeInterface getFacade()
 * @method \Spryker\Zed\CmsBlockCategoryConnector\Communication\CmsBlockCategoryConnectorCommunicationFactory getFactory()
 */
class CmsBlockCategoryConnectorUpdatePlugin extends AbstractPlugin implements CmsBlockUpdatePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CmsBlockTransfer $cmsBlockTransfer
     *
     * @return void
     */
    public function handleUpdate(CmsBlockTransfer $cmsBlockTransfer)
    {
        $this->getFacade()
            ->updateCmsBlockCategoryRelations($cmsBlockTransfer);
    }
}
