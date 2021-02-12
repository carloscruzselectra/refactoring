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
        $result = 0;

        switch ($rental->movie()->priceCode()) {
            case Movie::REGULAR:
                $result += 2;
                if ($rental->daysRented() > 2) {
                    $result += ($rental->daysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $rental->daysRented() * 3;
                break;
            case Movie::CHILDREN:
                $result += 1.5;
                if ($rental->daysRented() > 3) {
                    $result += ($rental->daysRented() - 3) * 1.5;
                }
                break;
            default:
                break;
        }

        return $result;
    }
}