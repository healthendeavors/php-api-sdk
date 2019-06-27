<?php

namespace Hendeavors\Http\Request;

use Hendeavors\Contracts\Http\Request\TokenRequestInterface;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class ClientCredentialsTokenRequest implements TokenRequestInterface
{
    private $provider;

    public function __construct(GenericProvider $provider)
    {
        $this->provider = $provider;
    }

    public function getAccessToken(): AccessTokenInterface
    {
        return $this->provider->getAccessToken('client_credentials');
    }
}
