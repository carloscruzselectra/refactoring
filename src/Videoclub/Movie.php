<?php

namespace App\Videoclub;

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

    public function price(): Price
    {
        return $this->price;
    }

    private function setPriceCode(int $priceCode): void
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
        return $this->price->getCharge($daysRented);
    }

    public function getFrequentRenterPoints(int $daysRented): int
    {
        return $this->price->getFrequentRenterPoints($daysRented);
    }
}