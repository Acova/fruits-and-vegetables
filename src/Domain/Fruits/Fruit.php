<?php

namespace App\Domain\Fruits;

interface Fruit
{
    public function getId(): int;
    public function getName(): string;
    public function getQuantity(): int;
}
