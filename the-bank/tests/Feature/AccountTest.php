<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Testing a successful user creation
     *
     * @return void
     */
    public function testSuccessAccountCreation()
    {
        $this->json('POST', 'api/accounts/create', [
            'user_id' => 1
        ])
            ->assertJson([
                'success' => true,
                'data' => [
                    'user_id' => 1
                ]
            ]);
    }

    /**
     * Testing an unsuccessful user creation with invalid id
     *
     * @return void
     */
    public function testFailureAccountCreation()
    {
        $this->json('POST', 'api/accounts/create', [
            'user_id' => -1
        ])
            ->assertJson([
                'success' => false,
                'message' => 'Validation errors',
                'data' => [
                    'user_id' => [
                        'The selected user id is invalid.'
                    ]
                ]
            ]);
    }

    /**
     * Testing to find all users successfully
     *
     * @return void
     */
    public function testSuccessAccountFindAll()
    {
        $response = $this->get('api/accounts');

        $response->assertJson([
            'success' => true,
            'data' => []
        ]);
    }

    /**
     * Testing to find one user successfully
     *
     * @return void
     */
    public function testSuccessAccountFind()
    {
        $response = $this->get('api/accounts/1');

        $response->assertJson([
            'success' => true,
            'data' => [
                'id' => 1
            ]
        ]);
    }

    /**
     * Testing to find all users successfully
     *
     * @return void
     */
    public function testFailureAccountFind()
    {
        $response = $this->get('api/accounts/1000000000');

        $response->assertNotFound();
    }

    /**
     * Testing a successful deposit an amount into an account
     *
     * @return void
     */
    public function testSuccessDepositIntoAccount()
    {
        $response = $this->post('api/accounts/deposit', [
            'account_id' => 1,
            'amount' => 100
        ]);

        $response->assertJson([
            'success' => true,
            'data' => [
                'transaction' => [
                    'account_id' => 1,
                    'amount' => 100
                ]
            ]
        ]);
    }

    /**
     * Testing a unsuccessful deposit an amount into an account
     *
     * @return void
     */
    public function testAccountIdFailureDepositIntoAccount()
    {
        $response = $this->post('api/accounts/deposit', [
            'account_id' => -1,
            'amount' => 100
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            'data' => [
                'account_id' => ['The selected account id is invalid.']
            ]
        ]);
    }

    /**
     * Testing a unsuccessful deposit an amount into an account
     *
     * @return void
     */
    public function testAmountFailureDepositIntoAccount()
    {
        $response = $this->post('api/accounts/deposit', [
            'account_id' => 1,
            'amount' => 0.999
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            'data' => [
                'amount' => ['The amount must be an integer.']
            ]
        ]);
    }

    /**
     * Testing a successful deposit an amount into an account
     *
     * @return void
     */
    public function testSuccessWithdrawFromAccount()
    {
        $response = $this->post('api/accounts/withdraw', [
            'account_id' => 1,
            'amount' => 100
        ]);

        $response->assertJson([
            'success' => true,
            'data' => [
                'transaction' => [
                    'account_id' => 1,
                    'amount' => -100
                ]
            ]
        ]);
    }

    /**
     * Testing a unsuccessful deposit an amount into an account
     *
     * @return void
     */
    public function testAccountIdFailureWithdrawFromAccount()
    {
        $response = $this->post('api/accounts/withdraw', [
            'account_id' => -1,
            'amount' => 100
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            'data' => [
                'account_id' => ['The selected account id is invalid.']
            ]
        ]);
    }

    /**
     * Testing a unsuccessful deposit an amount into an account
     *
     * @return void
     */
    public function testAmountFailureWithdrawFromAccount()
    {
        $response = $this->post('api/accounts/withdraw', [
            'account_id' => 1,
            'amount' => 0.999
        ]);

        $response->assertJson([
            'success' => false,
            'message' => 'Validation errors',
            'data' => [
                'amount' => ['The amount must be an integer.']
            ]
        ]);
    }

    /**
     * Testing a successful user creation with api mocking
     *
     * @return void
     */
    // public function testSuccessAccountCreationUsingApiFake()
    // {
    //     Http::fake([
    //         'https://swapi.dev/api/people/1/' => Http::response([
    //             'height' => 1
    //         ])
    //     ]);

    //     $this->json('POST', 'api/accounts/create/apitest')
    //         ->assertJson([
    //             'success' => true,
    //             'data' => [
    //                 'user_id' => 1,
    //                 'interest_rate' => 0.93,
    //                 'balance' => 0,
    //                 'interest_overflow' => 0
    //             ]
    //         ]);
    // }
}
