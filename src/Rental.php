<?php

namespace App;

class Rental
{
    private $movie;

    private $daysRented;

    public function __construct(Movie $movie, int $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function movie(): Movie
    {
        return $this->movie;
    }

    public function daysRented(): int
    {
        return $this->daysRented;
    }

    public function getFrequentRenterPoints(): int
    {
        $frequentRenterPoints = 1;

        if ($this->daysRented() > 1 && $this->movie()->priceCode() === Movie::NEW_RELEASE) {
            $frequentRenterPoints++;
        }

        return $frequentRenterPoints;
    }
}