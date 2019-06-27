<?php

namespace Hendeavors\Grant;

use Hendeavors\Contracts\ClientInterface;
use Hendeavors\Http\Request\ClientCredentialsTokenRequest;
use Hendeavors\Contracts\Grant\GrantInterface;

class ClientCredentialsGrant implements GrantInterface
{
    private $client;

    private $scope = "";

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function withScope(string $scope)
    {
        $this->scope = $scope;

        return $this;
    }

    public function getAccessToken()
    {
        return $this->client->getAccessToken(new ClientCredentialsTokenRequest($this->client->getProvider()));
    }
}
