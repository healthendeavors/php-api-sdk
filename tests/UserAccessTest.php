<?php

namespace Hendeavors\Tests;

use PHPUnit\Framework\TestCase;
use Hendeavors\HendeavorsProvider;
use Hendeavors\HendeavorsClient;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\Auth\Scoped\UserAccess;

class UserAccessTest extends TestCase
{
    /** @test */
    public function acquireUserAccessToken()
    {
        $provider = new HendeavorsProvider();
        $client = new HendeavorsClient($provider, "2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj", "");
        $grant = new ResourceOwnerPasswordGrant($client, "healthendeavorsadmin@healthendeavors.com", "HEPass$3456");

        $access = (new UserAccess);

        $access->using($grant);

        $token = $access->authenticate();
    }

    /** @test */
    public function acquireUserAccessTokenFactory()
    {
        $accessToken = (new UserAccess);

        $accessToken
        ->withClient("2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj")
        ->withPassword("healthendeavorsadmin@healthendeavors.com", "HEPass$3456");

        $token = $accessToken->authenticate();
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function properUserAccessUsage()
    {
        $accessToken = (new UserAccess)
        ->withClient("2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj")
        ->withPassword("healthendeavorsadmin@healthendeavors.com", "HEPass$3456")
        ->authenticate();
    }

    /**
     * @test
     * @expectedException \Hendeavors\Grant\Exception\InvalidGrantException
     * @expectedExceptionMessage The grant is scoped.
     */
    public function attemptTwoScopes()
    {
        $accessToken = (new UserAccess)
        ->withClient("2", "OHBW7pKKankEQoVGCFWzdZBrq2QwYXG3sPPOHoWW")
        ->withPassword("healthendeavorsadmin@healthendeavors.com", "HEPass$3456")
        ->withScope("myscope")
        ->withScope("myscope")
        ->authenticate();
    }
}
