<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\CompanyRole;

use Spryker\Zed\Kernel\AbstractBundleConfig;

class CompanyRoleConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getDefaultAdminRoleName(): string
    {
        return 'Admin';
    }
}
