<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\InterestServices;
use PHPUnit\Framework\TestCase;
use TypeError;

class InterestServicesTest extends TestCase
{
    /**
     *
     * Tests the interest rate calculation for incomes below 500000
     *
     * @return void
     */
    public function testCalculateInterestRateSuccess()
    {
        $input = 10;
        $expected = 0.93;
        $result = InterestServices::calculateInterestRate($input);
        $this->assertEquals($expected, $result);
    }

    /**
     *
     * Tests the interest rate calculation for incomes of 500000
     *
     * @return void
     */
    public function testCalculateInterestRateSuccess2()
    {
        $input = 500000;
        $expected = 1.02;
        $result = InterestServices::calculateInterestRate($input);
        $this->assertEquals($expected, $result);
    }

    /**
     *
     * Tests the interest rate calculation for incomes above 500000
     *
     * @return void
     */
    public function testCalculateInterestRateSuccess3()
    {
        $input = 100000000;
        $expected = 1.02;
        $result = InterestServices::calculateInterestRate($input);
        $this->assertEquals($expected, $result);
    }

    /**
     *
     * Tests the interest rate calculation for null incomes
     *
     * @return void
     */
    public function testCalculateInterestRateSuccess4()
    {
        $input = null;
        $expected = 0.5;
        $result = InterestServices::calculateInterestRate($input);
        $this->assertEquals($expected, $result);
    }

    /**
     *
     * Tests the interest rate calculation for malformed data
     *
     * @return void
     */
    public function testCalculateInterestRateMalformed()
    {
        $input = [null];
        $this->expectException(TypeError::class);
        $case = InterestServices::calculateInterestRate($input);
    }

    /**
     *
     * Tests the interest calculation for a successful result
     *
     * @return void
     */
    public function testCalculateInterestSuccess()
    {
        $input1 = 100;
        $input2 = 0.93;
        $expected = 0.00764384;
        $result = InterestServices::calculateInterest($input1, $input2);
        $this->assertEquals($expected, $result);
    }

    /**
     *
     * Tests the interest calculation for a successful result
     *
     * @return void
     */
    public function testCalculateInterestSuccess2()
    {
        $input1 = 2345;
        $input2 = 1.02;
        $expected = 0.19659452;
        $result = InterestServices::calculateInterest($input1, $input2);
        $this->assertEquals($expected, $result);
    }

    /**
     *
     * Tests the interest calculation for malformed data
     *
     * @return void
     */
    public function testCalculateInterestMalformed()
    {
        $input1 = [2345];
        $input2 = 1.02;
        $this->expectException(TypeError::class);
        $case = InterestServices::calculateInterest($input1, $input2);
    }

    /**
     *
     * Tests the interest calculation for malformed data
     *
     * @return void
     */
    public function testCalculateInterestMalformed2()
    {
        $input1 = 2345;
        $input2 = null;
        $this->expectException(TypeError::class);
        $case = InterestServices::calculateInterest($input1, $input2);
    }
}
