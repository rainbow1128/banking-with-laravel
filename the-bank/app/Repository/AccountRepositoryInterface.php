<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface AccountRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByUser(User $user): Collection;
}
