<?php

namespace App;

class NewReleasePrice extends Price
{
    public function getPrice(): int
    {
        return Movie::NEW_RELEASE;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return $daysRented > 1 ? 2 : 1;
    }
}