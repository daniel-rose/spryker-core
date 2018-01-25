<?php
/**
 * Copyright © 2018-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\AvailabilityStorage\Communication\Plugin\Event\Listener;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\EventEntityTransfer;
use Orm\Zed\AvailabilityStorage\Persistence\SpyAvailabilityStorageQuery;
use Orm\Zed\Product\Persistence\Map\SpyProductTableMap;
use PHPUnit\Framework\SkippedTestError;
use Propel\Runtime\Propel;
use Silex\Application;
use Spryker\Shared\Config\Config;
use Spryker\Shared\PropelQueryBuilder\PropelQueryBuilderConstants;
use Spryker\Zed\Availability\Dependency\AvailabilityEvents;
use Spryker\Zed\AvailabilityStorage\Business\AvailabilityStorageBusinessFactory;
use Spryker\Zed\AvailabilityStorage\Business\AvailabilityStorageFacade;
use Spryker\Zed\AvailabilityStorage\Communication\Plugin\Event\Listener\AvailabilityProductStorageListener;
use Spryker\Zed\AvailabilityStorage\Communication\Plugin\Event\Listener\AvailabilityStorageListener;
use Spryker\Zed\Product\Dependency\ProductEvents;
use Spryker\Zed\Propel\Communication\Plugin\ServiceProvider\PropelServiceProvider;
use SprykerTest\Zed\AvailabilityStorage\AvailabilityStorageConfigMock;

/**
 * Auto-generated group annotations
 * @group SprykerTest
 * @group Zed
 * @group AvailabilityStorage
 * @group Communication
 * @group Plugin
 * @group Event
 * @group Listener
 * @group AvailabilityStorageListenerTest
 * Add your own group annotations below this line
 */
class AvailabilityStorageListenerTest extends Unit
{
    /**
     * @throws \PHPUnit\Framework\SkippedTestError
     *
     * @return void
     */
    protected function setUp()
    {
        $dbType = Config::get(PropelQueryBuilderConstants::ZED_DB_ENGINE);
        if ($dbType !== 'pgsql') {
            throw new SkippedTestError('Warning: no PostgreSQL is detected');
        }

        Propel::disableInstancePooling();
        $propelServiceProvider = new PropelServiceProvider();
        $propelServiceProvider->boot(new Application());
    }

    /**
     * @return void
     */
    protected function tearDown()
    {
        SpyAvailabilityStorageQuery::create()->deleteall();
    }

    /**
     * @return void
     */
    public function testAvailabilityStorageListenerStoreData()
    {
        $availabilityStorageCount = SpyAvailabilityStorageQuery::create()->count();
        $this->assertSame(0, $availabilityStorageCount);

        // Act
        $availabilityStorageListener = new AvailabilityStorageListener();
        $availabilityStorageListener->setFacade($this->getAvailabilityStorageFacade());

        $eventTransfers = [
            (new EventEntityTransfer())->setId(1),
        ];
        $availabilityStorageListener->handleBulk($eventTransfers, AvailabilityEvents::AVAILABILITY_ABSTRACT_PUBLISH);

        // Assert
        $this->assertAvailabilityStorage();
    }

    /**
     * @return void
     */
    public function testAvailabilityProductStorageListenerStoreData()
    {
        $availabilityStorageCount = SpyAvailabilityStorageQuery::create()->count();
        $this->assertSame(0, $availabilityStorageCount);

        // Act
        $availabilityStorageListener = new AvailabilityProductStorageListener();
        $availabilityStorageListener->setFacade($this->getAvailabilityStorageFacade());

        $eventTransfers = [
            (new EventEntityTransfer())->setForeignKeys([
                SpyProductTableMap::COL_FK_PRODUCT_ABSTRACT => 1,
            ]),
        ];
        $availabilityStorageListener->handleBulk($eventTransfers, ProductEvents::ENTITY_SPY_PRODUCT_UPDATE);

        // Assert
        $this->assertAvailabilityStorage();
    }

    /**
     * @return \Spryker\Zed\AvailabilityStorage\Business\AvailabilityStorageFacade
     */
    protected function getAvailabilityStorageFacade()
    {
        $factory = new AvailabilityStorageBusinessFactory();
        $factory->setConfig(new AvailabilityStorageConfigMock());

        $facade = new AvailabilityStorageFacade();
        $facade->setFactory($factory);

        return $facade;
    }

    /**
     * @return void
     */
    protected function assertAvailabilityStorage()
    {
        $availabilityStorageCount = SpyAvailabilityStorageQuery::create()->count();
        $this->assertEquals(1, $availabilityStorageCount);
        $availabilityStorageEntity = SpyAvailabilityStorageQuery::create()->findOne();
        $this->assertEquals(1, $availabilityStorageEntity->getFkProductAbstract());
        $data = $availabilityStorageEntity->getData();
        $this->assertEquals(10, $data['quantity']);
    }
}