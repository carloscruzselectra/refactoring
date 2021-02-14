<?php

namespace App;

class NewReleasePrice extends Price
{
    public function getPrice(): int
    {
        return Movie::NEW_RELEASE;
    }
}