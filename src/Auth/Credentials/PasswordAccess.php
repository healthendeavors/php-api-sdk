<?php

namespace Hendeavors\Auth\Credentials;

use Hendeavors\Contracts\Auth\AccessInterface;

class PasswordAccess implements AccessInterface
{
    /**
     * Obtain access using a specific method
     * ->using("passsword") or ->using("code")
     */
    public function using(string $method): AccessInterface
    {

    }

    /**
     * Scopes are not a required configuration
     */
    public function withScope(string $scope): AccessInterface
    {

    }

    /**
     * Make the request to gain access(authenticate)
     */
    public function authenticate()
    {
        
    }
}
