<?php

namespace Tests\Videoclub;

use App\Videoclub\Movie;
use App\Videoclub\Rental;
use PHPUnit\Framework\TestCase;

class RentalTest extends TestCase
{
    /** @test */
    public function instantiating_a_rental(): void
    {
        $movie = new Movie('A quiet place', Movie::REGULAR);
        $rental = new Rental($movie, 3);

        self::assertSame($movie, $rental->movie());
        self::assertSame(3, $rental->daysRented());
        self::assertSame(3.5, $rental->getCharge());
        self::assertSame(1, $rental->getFrequentRenterPoints());
        self::assertSame(
            $movie->getFrequentRenterPoints($rental->daysRented()),
            $rental->getFrequentRenterPoints()
        );
        self::assertSame(
            $movie->getCharge($rental->daysRented()),
            $rental->getCharge()
        );
    }
}