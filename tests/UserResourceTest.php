<?php

namespace Hendeavors\Tests;

use Hendeavors\Http\Request\Resource\User;
use PHPUnit\Framework\TestCase;
use Hendeavors\Auth\Scoped\UserAccess;

class UserResourceTest extends TestCase
{

    /** @test */
    public function getUsers()
    {
        $access = (new UserAccess);

        $access
        ->withClient("2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj")
        ->withPassword("healthendeavorsadmin@healthendeavors.com", "HEPass$3456");

        $resource = User::fromToken($access->authenticate());

        $this->assertInternalType('int', $resource->first()->id());
    }

    /**
     * @test
     * @expectedException \LogicException
     */
    public function properUserAccessUsage()
    {
        $access = (new UserAccess);

        $access
        ->withClient("2", "9ZCWkURqK1H6QPwspVN58me9wiptDc1WN3d7nMdj")
        ->withPassword("healthendeavorsadmin@healthendeavors.com", "HEPass$3456")
        ->authenticate();
    }
}
