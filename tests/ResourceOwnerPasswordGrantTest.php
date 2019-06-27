<?php

namespace Hendeavors\Tests;

use PHPUnit\Framework\TestCase;
use Hendeavors\HendeavorsProvider;
use Hendeavors\Grant\ResourceOwnerPasswordGrant;
use Hendeavors\HendeavorsClient;

class ResourceOwnerPasswordGrantTest extends TestCase
{
    /** @test */
    public function createPasswordGrant()
    {
        $provider = new HendeavorsProvider();
        $client = new HendeavorsClient($provider, "2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj","");
        $grant = new ResourceOwnerPasswordGrant($client, "healthendeavorsadmin@healthendeavors.com", "HEPass$3456");
    }

    /** @test */
    public function getAccessTokenPasswordGrant()
    {
        $provider = new HendeavorsProvider();
        $client = new HendeavorsClient($provider, "2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj", "");
        $grant = new ResourceOwnerPasswordGrant($client, "healthendeavorsadmin@healthendeavors.com", "HEPass$3456");
        $token = $grant->getAccessToken();
    }
}
