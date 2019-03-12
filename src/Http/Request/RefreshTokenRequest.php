<?php

namespace Hendeavors\Http\Request;

use Hendeavors\Contracts\Http\Request\TokenRequestInterface;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class RefreshTokenRequest implements TokenRequestInterface
{
    private $provider;

    private $existingAccessToken;

    private $scope;

    public function __construct(GenericProvider $provider, string $existingAccessToken, string $scope)
    {
        $this->provider = $provider;

        $this->existingAccessToken = $existingAccessToken;

        $this->scope = $scope;
    }

    public function getAccessToken(): AccessTokenInterface
    {
        return $this->provider->getAccessToken('refresh_token', [
            'refresh_token' => $this->existingAccessToken,
            'scope' => $this->scope
        ]);
    }
}
