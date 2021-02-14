<?php

namespace App;

use http\Exception\InvalidArgumentException;

class Movie
{
    public const CHILDREN = 2;
    public const REGULAR = 0;
    public const NEW_RELEASE = 1;

    private $title;

    /** @var Price */
    private $price;

    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->setPriceCode($priceCode);
    }

    public function title(): string
    {
        return $this->title;
    }

    public function priceCode(): int
    {
        return $this->price->getPrice();
    }

    public function setPriceCode(int $priceCode): void
    {
        switch ($priceCode) {
            case self::REGULAR:
                $this->price = new RegularPrice();
                break;
            case self::NEW_RELEASE:
                $this->price = new NewReleasePrice();
                break;
            case self::CHILDREN:
                $this->price = new ChildrenPrice();
                break;
            default:
                throw new InvalidArgumentException('Incorrect price code');
        }
    }

    public function getCharge(int $daysRented): float
    {
        $result = 0;

        switch ($this->priceCode()) {
            case self::REGULAR:
                $result += 2;
                if ($daysRented > 2) {
                    $result += ($daysRented - 2) * 1.5;
                }
                break;
            case self::NEW_RELEASE:
                $result += $daysRented * 3;
                break;
            case self::CHILDREN:
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
        $frequentRenterPoints = 1;

        if ($daysRented > 1 && $this->priceCode() === self::NEW_RELEASE) {
            $frequentRenterPoints++;
        }

        return $frequentRenterPoints;
    }
}