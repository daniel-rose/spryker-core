<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Client\Company\Zed;

use Generated\Shared\Transfer\CompanyResponseTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Company\Dependency\Client\CompanyToZedRequestClientInterface;

class CompanyStub implements CompanyStubInterface
{
    /**
     * @var \Spryker\Client\Company\Dependency\Client\CompanyToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \Spryker\Client\Company\Dependency\Client\CompanyToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompanyToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function createCompany(CompanyTransfer $companyTransfer): CompanyResponseTransfer
    {
        return $this->zedRequestClient->call('/company/gateway/create', $companyTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function getCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->zedRequestClient->call('/company/gateway/get-company-by-id', $companyTransfer);
    }
}
