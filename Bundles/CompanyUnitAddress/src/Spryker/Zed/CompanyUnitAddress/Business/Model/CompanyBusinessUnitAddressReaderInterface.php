<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyUnitAddress\Business\Model;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer;

interface CompanyBusinessUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressCollectionTransfer
     */
    public function getCompanyBusinessUnitAddresses(
        CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
    ): CompanyUnitAddressCollectionTransfer;
}
