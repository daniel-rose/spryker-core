<?php

namespace Unit\Spryker\Zed\Development\Business\CodeStyleFixer;

use Spryker\Zed\Development\Business\CodeStyleFixer\NoIsNullFixer;

/**
 * @group Spryker
 * @group Zed
 * @group Development
 * @group CodeStyleFixer
 */
class NoIsNullFixerTest extends \PHPUnit_Framework_TestCase
{

    const FIXER_NAME = 'NoIsNullFixer';

    /**
     * @var NoIsNullFixer
     */
    protected $fixer;

    /**
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->fixer = new NoIsNullFixer();
    }

    /**
     * @dataProvider provideFixCases
     *
     * @param string $expected
     * @param string $input
     *
     * @return void
     */
    public function testFix($expected, $input = null)
    {
        $fileInfo = new \SplFileInfo(__FILE__);
        $this->assertSame($expected, $this->fixer->fix($fileInfo, $input));
    }

    /**
     * @return array
     */
    public function provideFixCases()
    {
        $fixturePath = __DIR__ . '/Fixtures/' . self::FIXER_NAME . '/';

        return [
            [
                file_get_contents($fixturePath . 'Expected/TestClass1Expected.php'),
                file_get_contents($fixturePath . 'Input/TestClass1Input.php'),
            ],
        ];
    }

}
