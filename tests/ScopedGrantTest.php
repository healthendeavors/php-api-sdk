<?php

namespace Hendeavors\Tests;

use PHPUnit\Framework\TestCase;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\Grant\ScopedGrant;
use Hendeavors\HendeavorsClient;

class ScopedGrantTest extends TestCase
{

    /** @test */
    public function getScopedGrantToken()
    {
        $provider = new HendeavorsProvider();
        $client = new HendeavorsClient($provider, "2", "OHBW7pKKankEQoVGCFWzdZBrq2QwYXG3sPPOHoWW", "");
        $grant = new ResourceOwnerPasswordGrant($client, "healthendeavorsadmin@healthendeavors.com", "HEPass$3456");
        $scoped = new ScopedGrant($grant, "users:read users:write");
        $token = $scoped->getAccessToken();
    }
}
