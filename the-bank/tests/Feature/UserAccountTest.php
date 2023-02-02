<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserAccountTest extends TestCase
{
    /**
     * Testing to find all of one user's accounts successfully
     *
     * @return void
     */
    public function testSuccessUserAccountFind()
    {
        $response = $this->get('api/users/2/accounts');

        $response->assertJson([
            'success' => true,
            'data' => []
        ]);
    }

    /**
     * Testing to find all of one user's accounts unsuccessfully
     *
     * @return void
     */
    public function testFailureUserAccountFind()
    {
        $response = $this->get('api/users/-1/accounts');

        $response->assertNotFound();
    }
}
