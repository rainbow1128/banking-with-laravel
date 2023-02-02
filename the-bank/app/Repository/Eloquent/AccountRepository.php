<?php

namespace App\Repository\Eloquent;

use App\Models\Account;
use App\Models\User;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class AccountRepository extends BaseRepository implements AccountRepositoryInterface
{
    protected $model;

    public function __construct(Account $model)
    {
        $this->model = $model;
    }

    public function findByUser(User $user): Collection
    {
        return $this->model->all()->where('user_id', '=', $user->id);
    }
}
