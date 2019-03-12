<?php

namespace Hendeavors\Grant;

use Hendeavors\Contracts\ClientInterface;
use Hendeavors\Http\Request\RefreshTokenRequest;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Hendeavors\Contracts\Grant\GrantInterface;

class TokenRefreshGrant implements GrantInterface
{
    private $client;

    private $existingAccessToken;

    private $scope = "";

    public function __construct(ClientInterface $client, AccessTokenInterface $existingAccessToken)
    {
        $this->client = $client;

        $this->existingAccessToken = $existingAccessToken;
    }

    public function withScope(string $scope)
    {
        $this->scope = $scope;

        return $this;
    }

    public function getAccessToken()
    {
        return $this->client->getAccessToken(new RefreshTokenRequest($this->client->getProvider(), $this->existingAccessToken->getRefreshToken(), $this->scope));
    }
}
