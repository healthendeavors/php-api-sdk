<?php

namespace Hendeavors\Grant;

use Hendeavors\Contracts\ClientInterface;
use Hendeavors\Http\Request\ResourceOwnerPasswordTokenRequest;
use Hendeavors\Contracts\Grant\GrantInterface;

class ResourceOwnerPasswordGrant implements GrantInterface
{
    private $client;

    private $username;

    private $password;

    private $scope = "";

    public function __construct(ClientInterface $client, string $username, string $password)
    {
        $this->client = $client;

        $this->username = $username;

        $this->password = $password;
    }

    public function withScope(string $scope)
    {
        $this->scope = $scope;

        return $this;
    }

    public function getAccessToken()
    {
        return $this->client->getAccessToken(new ResourceOwnerPasswordTokenRequest($this->client->getProvider(), $this->username, $this->password, $this->scope));
    }
}
