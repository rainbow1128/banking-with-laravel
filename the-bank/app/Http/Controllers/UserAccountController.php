<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repository\AccountRepositoryInterface;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    private $accountRepository;

    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function find(User $user)
    {
            return response()
                ->json(
                    [
                        'success' => true,
                        'data' => $this->accountRepository->findByUser($user)
                    ],
                    200
                );
    }
}
