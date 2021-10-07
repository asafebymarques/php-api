<?php

namespace ApiWebSac\Tests\Feature\Admin;

use ApiWebSac\Models\User;
use http\Env\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class UserTest extends TestCase
{
    /**
     * @test
     */
    public function testUser()
    {
        $response = $this->call('GET', '/user');
        $response->assertStatus(404);
    }
    /**
     * @test
     */
    public function testUserNameEqual()
    {
        $user = new User();
        $user->setKeyName("Leiviton");
        $this->assertEquals("Leiviton", $user->getKeyName());
    }
    /**
     * @test
     */
    public function testUserRest()
    {
        $response = $this->call('GET', '/user');
        $this->assertEquals(404, $response->status());
    }


}
