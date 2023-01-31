<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\AccountRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;
use App\Services\InterestServices;
use Illuminate\Http\Request;

class DepositInterestController extends Controller
{
    private $accountRepository;
    private $transactionRepository;

    public function __construct(
        AccountRepositoryInterface $accountRepository,
        TransactionRepositoryInterface $transactionRepository
    ) {
        $this->accountRepository = $accountRepository;
        $this->transactionRepository = $transactionRepository;
    }

    public function update(Account $account)
    {
        $account->interest_overflow += InterestServices::calculateInterest($account->balance, $account->interest_rate);

        if ($account->interest_overflow > 1) {
            $amount = $account->interest_overflow;

            $this->accountRepository->update(
                $account->id,
                [
                    'balance' => ($account->balance += $amount),
                    'interest_overflow' => 0,
                ]
            );

            $trans = $this->transactionRepository->create(
                [
                    'account_id' => $account->id,
                    'amount' => $amount,
                    'new_balance' => $account->balance,
                ]
            );

            $msg = $amount . " of interest added to account";
            $data = ['account' => $account, 'transaction' => $trans];
        } else {
            $this->accountRepository->update(
                $account->id,
                [
                    'interest_overflow' => $account->interest_overflow
                ]
            );

            $msg = "interest was added to the account's interest overflow";
            $data = $account;
        }

        return response()
            ->json(
                [
                    'success' => true,
                    'msg' => $msg,
                    'data' => $data,
                ],
                200
            );
    }
}
