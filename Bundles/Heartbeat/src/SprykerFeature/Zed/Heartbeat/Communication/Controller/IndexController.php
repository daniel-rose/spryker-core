<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Heartbeat\Communication\Controller;

use Spryker\Zed\Application\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{

    const SYSTEM_UP = 'UP';
    const SYSTEM_DOWN = 'DOWN';
    const SYSTEM_STATUS = 'status';
    const STATUS_REPORT = 'report';

    public function indexAction()
    {
        if ($this->getFacade()->isSystemAlive()) {
            return $this->jsonResponse(
                [self::SYSTEM_STATUS => self::SYSTEM_UP],
                Response::HTTP_OK
            );
        } else {
            return $this->jsonResponse(
                [self::SYSTEM_STATUS => self::SYSTEM_DOWN, self::STATUS_REPORT => $this->getFacade()->getReport()->toArray()],
                Response::HTTP_SERVICE_UNAVAILABLE
            );
        }
    }

}
