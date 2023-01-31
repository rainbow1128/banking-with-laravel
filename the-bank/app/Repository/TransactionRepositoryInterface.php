<?php

namespace App\Repository;

use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByAccount(Account $account): Collection;
}
