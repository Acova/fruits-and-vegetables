<?php

namespace App\Domain\Fruits;

interface Fruit
{
    public function getId(): ?int;
    public function setId(int $id): Fruit;
    public function getName(): ?string;
    public function setName(string $name): Fruit;
    public function getQuantity(): ?int;
    public function setQuantity(int $quantity): Fruit;
}
