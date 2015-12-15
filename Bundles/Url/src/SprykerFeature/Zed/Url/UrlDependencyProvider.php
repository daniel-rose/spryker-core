<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Url;

use Spryker\Zed\Propel\Communication\Plugin\Connection;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class UrlDependencyProvider extends AbstractBundleDependencyProvider
{

    const FACADE_LOCALE = 'locale facade';
    const FACADE_TOUCH = 'touch facade';
    const PLUGIN_PROPEL_CONNECTION = 'propel connection plugin';

    /**
     * @param Container $container
     *
     * @return Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container[self::FACADE_LOCALE] = function (Container $container) {
            return $container->getLocator()->locale()->facade();
        };

        $container[self::FACADE_TOUCH] = function (Container $container) {
            return $container->getLocator()->touch()->facade();
        };

        $container[self::PLUGIN_PROPEL_CONNECTION] = function () {
            return (new Connection())->get();
        };

        return $container;
    }

}
