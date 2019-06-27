<?php

namespace Hendeavors\Auth\Factory;

use Hendeavors\Contracts\Auth\FactoryBuilderInterface;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\Grant\ClientCredentialsGrant;
use Hendeavors\Grant\ScopedGrant;
use Hendeavors\HendeavorsClient;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Contracts\Grant\GrantInterface;
use Hendeavors\Grant\Exception\InvalidGrantException;
use LogicException;

class AccessBuilder implements FactoryBuilderInterface
{
    private $grant;

    private $client;

    public function using(GrantInterface $grant): FactoryBuilderInterface
    {
        $this->grant = $grant;

        return $this;
    }

    public function withClient($id, $secret, $redirect = ''): FactoryBuilderInterface
    {
        $provider = new HendeavorsProvider();

        $this->client = new HendeavorsClient($provider, $id, $secret, $redirect);

        return $this->using(new ClientCredentialsGrant($this->client));
    }

    public function withPassword($username, $password): FactoryBuilderInterface
    {
        if (null === $this->client) {
            throw InvalidGrantException::grantRequiresClient();
        }

        return $this->using(new ResourceOwnerPasswordGrant($this->client, $username, $password));
    }

    public function withScope(string $scope): FactoryBuilderInterface
    {
        if (null === $this->grant) {
            throw InvalidGrantException::scopeRequiresGrant();
        }

        return $this->using(new ScopedGrant($this->grant, $scope));
    }

    public function authenticate()
    {
        throw new LogicException("Invalid State. See Hendeavors\Contracts\Auth\AccessInterface for authentication.");
    }

    public function getGrant()
    {
        return $this->grant;
    }
}
