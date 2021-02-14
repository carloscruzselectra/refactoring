<?php

namespace App;

abstract class Price
{
    abstract public function getPrice(): int;
}