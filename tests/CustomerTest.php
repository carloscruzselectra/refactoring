<?php

namespace Tests;

use App\Customer;
use App\Movie;
use App\Rental;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    /** @test */
    public function it_returns_an_output_with_calculations(): void
    {
        $movie1 = new Movie('Home Alone', Movie::CHILDREN);
        $movie2 = new Movie('The Goonies', Movie::CHILDREN);
        $movie3 = new Movie('Tenet', Movie::NEW_RELEASE);
        $movie4 = new Movie('Pride and Prejudice', Movie::REGULAR);

        $customer = new Customer('Carlos');
        $customer->addRental(new Rental($movie1, 2));
        $customer->addRental(new Rental($movie2, 3));
        $customer->addRental(new Rental($movie3, 1));
        $customer->addRental(new Rental($movie4, 5));

        $expectedOutput = "Rental records for Carlos"
            . "\n\t" . "Home Alone" . "\t" . "1.5"
            . "\n\t" . "The Goonies" . "\t" . "1.5"
            . "\n\t" . "Tenet" . "\t" . "3"
            . "\n\t" . "Pride and Prejudice" . "\t" . "6.5"
            . "\n" . "Amount owed is 12.5"
            . "\n" . "You earned 4 frequent renter points";

        self::assertEquals($expectedOutput, $customer->statement());
    }
}