<?php

namespace App\Application\Vegetable;

class VegetableDTO
{
    public function __construct(
        public int|null $id,
        public string|null $name,
        public int|null $quantity
    ){   
    }
}