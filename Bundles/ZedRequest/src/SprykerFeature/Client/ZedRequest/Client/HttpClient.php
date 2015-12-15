<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Client\ZedRequest\Client;

use Spryker\Shared\Kernel\Factory\FactoryInterface;
use Spryker\Client\Auth\AuthClientInterface;
use Spryker\Shared\ZedRequest\Client\AbstractHttpClient;

class HttpClient extends AbstractHttpClient
{

    /**
     * @var string
     */
    protected $rawToken;

    /**
     * @param FactoryInterface $factory
     * @param AuthClientInterface $authClient
     * @param string $baseUrl
     * @param string $rawToken
     */
    public function __construct(
        FactoryInterface $factory,
        AuthClientInterface $authClient,
        $baseUrl,
        $rawToken
    ) {
        parent::__construct($factory, $authClient, $baseUrl);
        $this->rawToken = $rawToken;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        $headers = [
            'Auth-Token' => $this->authClient->generateToken($this->rawToken),
        ];

        return $headers;
    }

}
