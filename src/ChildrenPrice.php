<?php

namespace App;

class ChildrenPrice extends Price
{
    public function getPrice(): int
    {
        return Movie::CHILDREN;
    }
}