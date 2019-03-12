<?php

namespace Hendeavors\Contracts;

use Hendeavors\Contracts\Http\Request\TokenRequestInterface;

interface ClientInterface
{
    function getAccessToken(TokenRequestInterface $request);
}
