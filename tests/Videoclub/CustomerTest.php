<?php

namespace Tests\Videoclub;

use App\Videoclub\Customer;
use App\Videoclub\Movie;
use App\Videoclub\Rental;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    private $customer;

    protected function setUp(): void
    {
        $movie1 = new Movie('Home Alone', Movie::CHILDREN);
        $movie2 = new Movie('The Goonies', Movie::CHILDREN);
        $movie3 = new Movie('Tenet', Movie::NEW_RELEASE);
        $movie4 = new Movie('Pride and Prejudice', Movie::REGULAR);

        $this->customer = new Customer('Carlos');

        $this->customer->addRental(new Rental($movie1, 2));
        $this->customer->addRental(new Rental($movie2, 3));
        $this->customer->addRental(new Rental($movie3, 1));
        $this->customer->addRental(new Rental($movie4, 5));

        parent::setUp();
    }

    /** @test */
    public function it_returns_an_output_with_calculations(): void
    {
        $expectedOutput = "Rental records for Carlos"
            . "\n\t" . "Home Alone" . "\t" . "1.5"
            . "\n\t" . "The Goonies" . "\t" . "1.5"
            . "\n\t" . "Tenet" . "\t" . "3"
            . "\n\t" . "Pride and Prejudice" . "\t" . "6.5"
            . "\n" . "Amount owed is 12.5"
            . "\n" . "You earned 4 frequent renter points";

        self::assertEquals($expectedOutput, $this->customer->statement());
    }

    /** @test */
    public function it_returns_an_html_output_with_calculations(): void
    {
        $expectedOutput = "<h1><em>Rental records for Carlos</em></h1>"
            . "Home Alone: 1.5<br>"
            . "The Goonies: 1.5<br>"
            . "Tenet: 3<br>"
            . "Pride and Prejudice: 6.5<br>"
            . "<p>Amount owed is 12.5</p>"
            . "<p>You earned 4 frequent renter points</p>";

        self::assertEquals($expectedOutput, $this->customer->htmlStatement());
    }
}