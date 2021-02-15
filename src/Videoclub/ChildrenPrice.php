<?php

namespace App\Videoclub;

class ChildrenPrice extends Price
{
    public function getPrice(): int
    {
        return Movie::CHILDREN;
    }
}