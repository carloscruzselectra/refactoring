<?php

namespace App;

class Customer
{
    private $name;

    private $rentals = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addRental(Rental $rental): void
    {
        $this->rentals[] = $rental;
    }

    public function statement(): string
    {
        $totalAmount = 0;
        $result = "Rental records for " . $this->name() . "\n";

        foreach ($this->rentals as $rental) {
            /** @var Rental $rental */
            $result .= "\t" . $rental->movie()->title() . "\t" . $rental->getCharge() . "\n";

            $totalAmount += $rental->getCharge();
        }

        $result .= 'Amount owed is '
            . $totalAmount . "\n"
            . 'You earned ' . $this->getTotalRenterPoints() . ' frequent renter points';

        return $result;
    }

    private function getTotalRenterPoints(): int
    {
        $result = 0;

        foreach ($this->rentals as $rental) {
            /** @var Rental $rental */
            $result += $rental->getFrequentRenterPoints();
        }

        return $result;
    }
}