<?php

namespace Hendeavors\Contracts\Auth;

use Hendeavors\Contracts\Grant\GrantInterface;

interface FactoryBuilderInterface
{
    function using(GrantInterface $grant): FactoryBuilderInterface;

    function withClient($id, $secret, $redirect = ''): FactoryBuilderInterface;

    function withPassword($username, $password): FactoryBuilderInterface;

    function withScope(string $scope): FactoryBuilderInterface;
}
