<?php

namespace Hendeavors\Tests;

use PHPUnit\Framework\TestCase;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\Grant\TokenRefreshGrant;
use Hendeavors\HendeavorsClient;

class TokenRefreshGrantTest extends TestCase
{
    /** @test */
    public function refreshAccessToken()
    {
        $provider = new HendeavorsProvider();
        $client = new HendeavorsClient($provider, "2", "OHBW7pKKankEQoVGCFWzdZBrq2QwYXG3sPPOHoWW", "");
        $grant = new ResourceOwnerPasswordGrant($client, "healthendeavorsadmin@healthendeavors.com", "HEPass$3456");
        // acquire a token to refresh
        $token = $grant->getAccessToken();
        $refreshGrant = new TokenRefreshGrant($client, $token);
        $newToken = $refreshGrant->getAccessToken();
    }
}
