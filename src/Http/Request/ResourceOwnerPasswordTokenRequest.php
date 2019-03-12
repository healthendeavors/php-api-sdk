<?php

namespace Hendeavors\Http\Request;

use Hendeavors\Contracts\Http\Request\TokenRequestInterface;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class ResourceOwnerPasswordTokenRequest implements TokenRequestInterface
{
    private $provider;

    private $username;

    private $password;

    private $scope;

    public function __construct(GenericProvider $provider, string $username, string $password, string $scope)
    {
        $this->provider = $provider;

        $this->username = $username;

        $this->password = $password;

        $this->scope = $scope;
    }

    public function getAccessToken(): AccessTokenInterface
    {
        return $this->provider->getAccessToken('password', [
            'username' => $this->username,
            'password' => $this->password,
            'scope' => $this->scope
        ]);
    }
}
