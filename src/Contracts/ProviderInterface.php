<?php

namespace Hendeavors\Contracts;

use Hendeavors\Contracts\Http\Request\TokenRequestInterface;

interface ProviderInterface
{
    function getTokenUrl(): string;

    function getAuthorizationUrl(): string;
}
