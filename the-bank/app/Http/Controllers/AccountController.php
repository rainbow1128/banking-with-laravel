<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\MakeDepositRequest;
use App\Models\Account;
use App\Repository\AccountRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Services\InterestServices;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{
    private $accountRepository;
    private $transactionRepository;
    private $userRepository;

    public function __construct(
        AccountRepositoryInterface $accountRepository,
        TransactionRepositoryInterface $transactionRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->accountRepository->all()
                ],
                200
            );
    }

    public function findOne(Account $account)
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->accountRepository->findById($account->id)
                ],
                200
            );
    }

    public function makeDeposit(MakeDepositRequest $requestVal)
    {
        $account = $this->accountRepository->findById(request('account_id'));

        $this->accountRepository->update(
            request('account_id'),
            [
                'balance' => ($account->balance + request('amount'))
            ]
        );

        return response()
            ->json(
                [
                    'success' => true,
                    'data' => [
                        'transaction' => $this->transactionRepository->create(
                            [
                                'account_id' => request('account_id'),
                                'amount' => request('amount'),
                                'new_balance' => $account->balance,
                            ]
                        )
                    ]
                ]
            );
    }

    public function create(CreateAccountRequest $requestVal)
    {
        $user = $this->userRepository->findById(request('user_id'));

        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->accountRepository->create(
                        [
                            'user_id' => $user->id,
                            'balance' => 0,
                            'interest_rate' => InterestServices::calculateInterestRate($user->income),
                            'interest_overflow' => 0
                        ]
                    )
                ],
                200
            );
    }

    public function createWithApi()
    {
        $userIncome = Http::get('https://swapi.dev/api/people/1/')['height'];

        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->accountRepository->create(
                        [
                            'user_id' => 1,
                            'balance' => 0,
                            'interest_rate' => InterestServices::calculateInterestRate($userIncome * 1000),
                            'interest_overflow' => 0
                        ]
                    )
                ],
                200
            );
    }
}
