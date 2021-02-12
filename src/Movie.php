<?php

namespace App;

class Movie
{
    public const CHILDREN = 2;
    public const REGULAR = 0;
    public const NEW_RELEASE = 1;

    private $title;

    private $priceCode;

    public function __construct(string $title, int $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function priceCode(): int
    {
        return $this->priceCode;
    }

    public function setPriceCode(int $priceCode): void
    {
        $this->priceCode = $priceCode;
    }
}