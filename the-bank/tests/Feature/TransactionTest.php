<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Testing to find all transactions
     *
     * @return void
     */
    public function testTransactionsFindAll()
    {
        $response = $this->get('/api/transactions');

        $response->assertJson([
            'success' => true,
            'data' => []
        ]);
    }

    /**
     * Testing to successfully find all transactions relating to one account
     *
     * @return void
     */
    public function testSuccessTransactionsFindOneAccounts()
    {
        $response = $this->get('/api/transactions/1');

        $response->assertJson([
            'success' => true,
            'data' => []
        ]);
    }

    /**
     * Testing to unsuccessfully find all transactions relating to one account
     *
     * @return void
     */
    public function testFailureTransactionsFindOneAccounts()
    {
        $response = $this->get('/api/transactions/10000000');

        $response->assertNotFound();
    }
}
