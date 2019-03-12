<?php

namespace Hendeavors\Contracts\Http\Request;

use League\OAuth2\Client\Token\AccessTokenInterface;

interface TokenRequestInterface
{
    function getAccessToken(): AccessTokenInterface;
}
