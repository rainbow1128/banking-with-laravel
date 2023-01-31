<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositInterestTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Testing a successful interest deposit into an account
     *
     * @return void
     */
    public function testSuccessDepositInterestSuccess()
    {
        $response = $this->patch('api/accounts/interest/1');

        $response->assertJson([
            'success' => true,
            'data' => [
                'account' => [
                    'id' => 1
                ]
            ]
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailureDepositInterestSuccess()
    {
        $response = $this->patch('api/accounts/interest/10000000000');

        $response->assertNotFound();
    }
}
