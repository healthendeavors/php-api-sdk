<?php

namespace Hendeavors\Auth\Factory;

use Hendeavors\Contracts\Auth\FactoryBuilderInterface;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\Grant\ScopedGrant;
use Hendeavors\HendeavorsClient;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Contracts\Grant\GrantInterface;
use Hendeavors\Grant\Exception\InvalidGrantException;

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

        return $this;
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

        $this->using(new ScopedGrant($this->grant, $scope));

        return $this;
    }

    public function authenticate()
    {
        throw new \LogicException("Invalid State. See Hendeavors\Contracts\Auth\AccessInterface for authentication.");
    }

    public function getGrant()
    {
        return $this->grant;
    }
}
