<?php

namespace Hendeavors\Auth\Scoped;

use Hendeavors\Contracts\Auth\AccessInterface;
use Hendeavors\Contracts\Grant\GrantInterface;
use Hendeavors\Auth\Access;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\HendeavorsClient;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Contracts\Auth\FactoryBuilderInterface;

class UserAccess extends Access implements AccessInterface, FactoryBuilderInterface
{
    private $builder;

    public function using(GrantInterface $grant): FactoryBuilderInterface
    {
        return parent::using($grant)->withScope("users:read users:write");
    }

    public function withClient($id, $secret, $redirect = ''): FactoryBuilderInterface
    {
        $this->builder = parent::withClient($id, $secret, $redirect);

        return $this;
    }

    /**
     * Deletegate to the builder
     * @param  string $username [description]
     * @param  string $password [description]
     * @return FactoryBuilderInterface [description]
     */
    public function withPassword($username, $password): FactoryBuilderInterface
    {
        $this->builder = parent::withPassword($username, $password)->withScope("users:read users:write");

        return $this->builder;
    }
}
