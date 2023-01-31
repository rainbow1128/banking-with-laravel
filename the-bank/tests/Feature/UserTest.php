<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessUserCreation()
    {
        $this->json('POST', 'api/users/create', [
            'name' => 'Aidan',
            'income' => '3750000',
            'email' => 'aidan@g.com',
            'password' => 'password',
            ])
            ->assertJson([
                'success' => true
            ]);
    }

    public function testFailureUserCreation()
    {
        $this->json('POST', 'api/users/create', [
            'name' => 'Aidan',
            'income' => '3750000',
            'email' => 'aidan',
            'password' => 'password',
            ])
            ->assertJson([
                'success' => false,
                'message' => 'Validation errors',
                'data' => [
                    'email' => [
                        "The email must be a valid email address."
                    ]
                ]
            ]);
    }

    public function testSuccessUserFind()
    {
        $response = $this->get('/api/users/1');

        $response->assertJson(['success' => true]);
    }

    public function testFailureUserFind()
    {
        $response = $this->get('/api/users/1000000000000');

        $response->assertNotFound();
    }

    public function testUserFindAll()
    {
        $response = $this->get('api/users');

        $response->assertJson([
            'success' => true,
            'data' => []
        ]);
    }
}
