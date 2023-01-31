<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Repository\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->transactionRepository->all()
                ],
                200
            );
    }

    public function find(Account $account)
    {
        return response()
            ->json(
                [
                    'success' => true,
                    'data' => $this->transactionRepository->findByAccount($account)
                ],
                200
            );
    }
}
