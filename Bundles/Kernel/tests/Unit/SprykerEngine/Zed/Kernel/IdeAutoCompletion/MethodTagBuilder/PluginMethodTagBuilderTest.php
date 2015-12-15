<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Unit\Spryker\Zed\Kernel\IdeAutoCompletion;

use Spryker\Zed\Kernel\IdeAutoCompletion\MethodTagBuilder\PluginMethodTagBuilder;
use Spryker\Shared\Library\Autoloader;

/**
 * @group Kernel
 * @group MethodTagBuilder
 */
class PluginMethodTagBuilderTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @return void
     */
    public function testBuildMethodTagsShouldReturnVendorMethodTagIfProjectDoesNotOverrideIt()
    {
        $options = [
            PluginMethodTagBuilder::OPTION_KEY_APPLICATION => 'Application',
            PluginMethodTagBuilder::OPTION_KEY_PROJECT_PATH_PATTERN => __DIR__ . '/Fixtures/src/',
            PluginMethodTagBuilder::OPTION_KEY_VENDOR_PATH_PATTERN => __DIR__ . '/Fixtures/vendor/*/*/src/',
        ];

        $methodTagBuilder = new PluginMethodTagBuilder($options);
        $methodTags = $methodTagBuilder->buildMethodTags('Bundle');
        $expectedMethodTag = ' * @method \VendorNamespace\Application\Bundle\Communication\Plugin\Foo pluginFoo()';
        $this->assertContains($expectedMethodTag, $methodTags);

        $expectedMethodTag = ' * @method \VendorNamespace\Application\Bundle\Communication\Plugin\Bar pluginBar()';
        $this->assertContains($expectedMethodTag, $methodTags);
    }

    /**
     * @return void
     */
    public function testBuildMethodTagsShouldReturnProjectMethodTagIfProjectOverrideIt()
    {
        $options = [
            PluginMethodTagBuilder::OPTION_KEY_APPLICATION => 'Application',
            PluginMethodTagBuilder::OPTION_KEY_PROJECT_PATH_PATTERN => __DIR__ . '/Fixtures/src/',
            PluginMethodTagBuilder::OPTION_KEY_VENDOR_PATH_PATTERN => __DIR__ . '/Fixtures/vendor/*/*/src/',
        ];

        $methodTagBuilder = new PluginMethodTagBuilder($options);
        $methodTags = $methodTagBuilder->buildMethodTags('Bundle');

        $expectedMethodTag = ' * @method \ProjectNamespace\Application\Bundle\Communication\Plugin\Baz pluginBaz()';
        $this->assertContains($expectedMethodTag, $methodTags);
    }

    /**
     * @return void
     */
    public function testBuildMethodTagsShouldNotReturnMethodTagForNotInstantiableClass()
    {
        Autoloader::allowNamespace('ProjectNamespace');

        $options = [
            PluginMethodTagBuilder::OPTION_KEY_APPLICATION => 'Application',
            PluginMethodTagBuilder::OPTION_KEY_PROJECT_PATH_PATTERN => __DIR__ . '/Fixtures/src/',
            PluginMethodTagBuilder::OPTION_KEY_VENDOR_PATH_PATTERN => __DIR__ . '/Fixtures/vendor/*/*/src/',
        ];

        $methodTagBuilder = new PluginMethodTagBuilder($options);
        $methodTags = $methodTagBuilder->buildMethodTags('Bundle');

        $expectedMethodTag = ' * @method \ProjectNamespace\Application\Bundle\Communication\Plugin\AbstractFoo pluginAbstractFoo()';
        $this->assertNotContains($expectedMethodTag, $methodTags);

        $expectedMethodTag = ' * @method \ProjectNamespace\Application\Bundle\Communication\Plugin\FooInterface pluginFooInterface()';
        $this->assertNotContains($expectedMethodTag, $methodTags);

        $expectedMethodTag = ' * @method \ProjectNamespace\Application\Bundle\Communication\Plugin\FooTrait pluginFooTrait()';
        $this->assertNotContains($expectedMethodTag, $methodTags);
    }

}
