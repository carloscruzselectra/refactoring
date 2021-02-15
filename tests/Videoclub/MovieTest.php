<?php

namespace Tests\Videoclub;

use App\Videoclub\Movie;
use App\Videoclub\NewReleasePrice;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    /** @test */
    public function it_creates_a_movie(): void
    {
        $movie = new Movie('Street Kings', 1);
        self::assertSame('Street Kings', $movie->title());
        self::assertSame(1, $movie->priceCode());
        self::assertInstanceOf(NewReleasePrice::class, $movie->price());

        self::assertEquals(3, $movie->getCharge(1));
        self::assertEquals(2, $movie->getFrequentRenterPoints(3));
    }
}