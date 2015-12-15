<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Zed\Kernel\Communication;

use Spryker\Zed\Kernel\Communication\Controller\RouteNameResolver;
use Symfony\Component\HttpFoundation\Request;

/**
 * @group Kernel
 * @group RouteNameResolver
 */
class RouteNameResolverTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testRouteNameResolverShouldReturnRouteNameExtractedFromRequest()
    {
        $request = new Request([], [], ['module' => 'foo', 'controller' => 'bar', 'action' => 'baz']);
        $routeNameResolver = new RouteNameResolver($request);

        $this->assertSame('Foo/Bar/baz', $routeNameResolver->resolve());
    }

}
