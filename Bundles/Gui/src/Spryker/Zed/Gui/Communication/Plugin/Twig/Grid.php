<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Gui\Communication\Plugin\Twig;

use Spryker\Zed\Library\Twig\TwigFunction;

class Grid extends TwigFunction
{

    /**
     * @return string
     */
    protected function getFunctionName()
    {
        return 'grid';
    }

    /**
     * @return callable
     */
    protected function getFunction()
    {
        return function ($grid) {
            return $grid;
        };
    }

}