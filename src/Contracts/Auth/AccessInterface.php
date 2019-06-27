<?php

namespace Hendeavors\Contracts\Auth;

use Hendeavors\Contracts\Grant\GrantInterface;
use League\OAuth2\Client\Token\AccessTokenInterface;

/**
 * Describes how to get access
 */
interface AccessInterface
{
    /**
     * Make the request to gain access(authenticate)
     */
    function authenticate(): AccessTokenInterface;
}
