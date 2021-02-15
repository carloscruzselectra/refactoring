<?php

namespace App\Videoclub;

abstract class Price
{
    abstract public function getPrice(): int;

    public function getCharge(int $daysRented)
    {
        $result = 0;

        switch ($this->getPrice()) {
            case Movie::REGULAR:
                $result += 2;
                if ($daysRented > 2) {
                    $result += ($daysRented - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $result += $daysRented * 3;
                break;
            case Movie::CHILDREN:
                $result += 1.5;
                if ($daysRented > 3) {
                    $result += ($daysRented - 3) * 1.5;
                }
                break;
            default:
                break;
        }

        return $result;
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return 1;
    }
}