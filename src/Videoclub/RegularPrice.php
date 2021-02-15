<?php

namespace App\Videoclub;

class RegularPrice extends Price
{
    public function getPrice(): int
    {
        return Movie::REGULAR;
    }
}