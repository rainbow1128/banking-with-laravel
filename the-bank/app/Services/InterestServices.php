<?php

namespace App\Services;

use App\Models\Account;

class InterestServices
{
    public static function calculateInterestRate(?int $income): float
    {
        if ($income >= 500000) {
            $interest = 1.02;
        } elseif ($income < 500000 && $income > 0) {
            $interest = 0.93;
        } else {
            $interest = 0.5;
        }

        return $interest;
    }

    public static function calculateInterest(int $balance, float $interest_rate): float
    {
        return round($balance * $interest_rate / 100 / 365 * 3, 8);
    }
}
