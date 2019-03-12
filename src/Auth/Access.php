<?php

namespace Hendeavors\Auth;

use Hendeavors\Contracts\Auth\AccessInterface;
use Hendeavors\Contracts\Auth\FactoryBuilderInterface;
use Hendeavors\Auth\Credentials\PasswordAccess;
use Hendeavors\Contracts\Grant\GrantInterface;
use Hendeavors\Grant\Exception\InvalidGrantException;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\Grant\ScopedGrant;
use Hendeavors\HendeavorsClient;
use Hendeavors\HendeavorsProvider;

class Access implements AccessInterface
{
    private $factory;

    /**
     * Obtain access using a specific grant
     */
    public function using(GrantInterface $grant): FactoryBuilderInterface
    {
        return $this->delegates($this->getFactory()->using($grant));
    }

    public function withClient($id, $secret, $redirect = ''): FactoryBuilderInterface
    {
        return $this->delegates($this->getFactory()->withClient($id, $secret, $redirect));
    }

    public function withPassword($username, $password): FactoryBuilderInterface
    {
        return $this->delegates($this->getFactory()->withPassword($username, $password));
    }

    /**
     * Scopes are not a required configuration
     */
    public function withScope(string $scope): FactoryBuilderInterface
    {
        return $this->delegates($this->getFactory()->withScope($scope));
    }

    /**
     * Make the request to gain access(authenticate)
     */
    public function authenticate()
    {
        if (null === ($grant = $this->getFactory()->getGrant())) {
            throw InvalidGrantException::missingAuthenticationGrant();
        }

        return $grant->getAccessToken();
    }

    protected function delegates($factory)
    {
        $this->factory = $factory;

        return $this->factory;
    }

    protected function getFactory()
    {
        if (null === $this->factory) {
            return new Factory\AccessBuilder();
        }

        return $this->factory;
    }
}
