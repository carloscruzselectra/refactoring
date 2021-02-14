<?php

namespace App;

class RegularPrice extends Price
{
    public function getPrice(): int
    {
        return Movie::REGULAR;
    }
}