<?php

namespace Hendeavors\Auth\Scoped;

use Hendeavors\Contracts\Auth\AccessInterface;
use Hendeavors\Contracts\Grant\GrantInterface;
use Hendeavors\Auth\Access;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\HendeavorsClient;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Contracts\Auth\FactoryBuilderInterface;

class UserAccess extends Access implements AccessInterface
{
    public function using(GrantInterface $grant): FactoryBuilderInterface
    {
        return parent::using($grant)->withScope("users:read users:write");
    }
}
