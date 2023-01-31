<?php

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\TransactionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository extends BaseRepository implements TransactionRepositoryInterface
{
    protected $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function findByAccount(Account $account): Collection
    {
        return $this->model->latest()
                        ->where('account_id', '=', $account->id)
                        ->get();
    }
}
