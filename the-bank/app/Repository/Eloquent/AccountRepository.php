<?php

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Repository\AccountRepositoryInterface;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    protected $model;

    public function __construct(Account $model)
    {
        $this->model = $model;
    }
}
