
<?php

use PHPUnit\Framework\TestCase;
use App\FizzBuzz;

class FizzBuzzTest extends TestCase
{
    public function testReturnsFizzForMultiplesOf3()
    {
        $this->assertEquals('Fizz', FizzBuzz::generate(3));
        $this->assertEquals('Fizz', FizzBuzz::generate(6));
        $this->assertEquals('Fizz', FizzBuzz::generate(9));
    }

    public function testReturnsBuzzForMultiplesOf5()
    {
        $this->assertEquals('Buzz', FizzBuzz::generate(5));
        $this->assertEquals('Buzz', FizzBuzz::generate(10));
    }

    public function testReturnsFizzBuzzForMultiplesOf15()
    {
        $this->assertEquals('FizzBuzz', FizzBuzz::generate(15));
        $this->assertEquals('FizzBuzz', FizzBuzz::generate(30));
    }

    public function testReturnsNumberIfNotMultipleOf3Or5()
    {
        $this->assertEquals('1', FizzBuzz::generate(1));
        $this->assertEquals('2', FizzBuzz::generate(2));
        $this->assertEquals('4', FizzBuzz::generate(4));
    }
}
