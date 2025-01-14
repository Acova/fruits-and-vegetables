<?php

namespace App\Application\Fruit;

class FruitDTO
{
    public function __construct(
        public int|null $id,
        public string|null $name,
        public int|null $quantity
    ){   
    }
}