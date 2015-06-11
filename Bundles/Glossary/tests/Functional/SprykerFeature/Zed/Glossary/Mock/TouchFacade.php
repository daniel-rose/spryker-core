<?php

/*
 * (c) Copyright Spryker Systems GmbH 2015
 */

namespace Functional\SprykerFeature\Zed\Glossary\Mock;

use SprykerEngine\Zed\Touch\Business\TouchFacade as SprykerTouchFacade;
use SprykerFeature\Zed\Glossary\Dependency\Facade\GlossaryToTouchInterface;

class TouchFacade extends SprykerTouchFacade implements GlossaryToTouchInterface
{
}