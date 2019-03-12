<?php

namespace Hendeavors\Contracts\Auth;

use Hendeavors\Contracts\Grant\GrantInterface;

/**
 * Describes how to get access
 */
interface AccessInterface
{
    /**
     * Make the request to gain access(authenticate)
     */
    function authenticate();
}
