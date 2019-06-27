<?php

namespace Hendeavors\Grant;

use Hendeavors\Contracts\ClientInterface;
use Hendeavors\Http\Request\ResourceOwnerPasswordTokenRequest;
use Hendeavors\Contracts\Grant\GrantInterface;

class ScopedGrant implements GrantInterface
{
    private $grant;

    public function __construct(GrantInterface $grant, string $scope)
    {
        $this->grant = $grant->withScope($scope);
    }

    public function getAccessToken()
    {
        return $this->grant->getAccessToken();
    }

    public function withScope(string $scope)
    {
        throw Exception\InvalidGrantException::grantAlreadyScoped();
    }
}
