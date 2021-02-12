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
        $frequentRenterPoints = 0;
        $rentals = $this->rentals;

        $result = "Rental records for " . $this->name() . "\n";

        foreach ($rentals as $rental) {
            $localAmount = $this->amountFor($rental);

            $frequentRenterPoints++;

            if ($rental->daysRented() > 1 && $rental->movie()->priceCode() === Movie::NEW_RELEASE) {
                $frequentRenterPoints++;
            }

            $result .= "\t" . $rental->movie()->title() . "\t" . $localAmount . "\n";

            $totalAmount += $localAmount;
        }

        $result .= 'Amount owed is '
            . $totalAmount . "\n"
            . 'You earned ' . $frequentRenterPoints . ' frequent renter points';

        return $result;
    }

    private function amountFor(Rental $rental): float
    {
        return $rental->getCharge();
    }
}