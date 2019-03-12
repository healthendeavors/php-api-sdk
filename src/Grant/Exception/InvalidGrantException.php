<?php

namespace Hendeavors\Grant\Exception;

use League\OAuth2\Client\Grant\Exception\InvalidGrantException as LeagueInvalidGrantException;

/**
 * Exception thrown if the grant is not specified before authentication
 *
 * @see League\OAuth2\Client\Grant\AbstractGrant
 */
class InvalidGrantException extends LeagueInvalidGrantException
{
    private $hint = '';

    public function __construct($message, $hint, $code)
    {
        parent::__construct($message, $code);

        $this->hint = $hint;
    }

    public static function scopeRequiresGrant()
    {
        $errorMessage = "A grant must be specified before applying scopes.";

        $hint = "Check the Hendeavors\Contracts\Auth\AccessInterface.";

        return new static($errorMessage, $hint, 1001);
    }

    public static function grantRequiresClient()
    {
        $errorMessage = "A client must be specified prior to grant specification";

        $hint = "See Hendeavors\Contracts\Auth\AccessInterface [withClient].";

        return new static($errorMessage, $hint, 1002);
    }

    public static function missingAuthenticationGrant()
    {
        $errorMessage = "Authentication requires a grant type.";

        $hint = "See Hendeavors\Contracts\Auth\AccessInterface.";

        return new static($errorMessage, $hint, 1003);
    }

    public function getHint()
    {
        return $this->hint;
    }
}
