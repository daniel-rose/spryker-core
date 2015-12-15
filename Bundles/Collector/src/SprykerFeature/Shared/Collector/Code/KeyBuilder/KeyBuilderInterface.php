<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Shared\Collector\Code\KeyBuilder;

interface KeyBuilderInterface
{

    /**
     * @param mixed $data
     * @param string $localeName
     *
     * @return string
     */
    public function generateKey($data, $localeName);

}
