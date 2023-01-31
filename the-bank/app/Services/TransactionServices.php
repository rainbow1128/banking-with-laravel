<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionServices
{
    public static function create(array $accountDetails)
    {
        return Transaction::create($accountDetails);
    }
}
