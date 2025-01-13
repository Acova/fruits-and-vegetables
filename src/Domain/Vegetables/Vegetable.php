<?php

namespace App\Domain\Vegetables;

interface Vegetable
{
    public function getId(): ?int;
    public function setId(int $id): Vegetable;
    public function getName(): ?string;
    public function setName(string $name): Vegetable;
    public function getQuantity(): ?int;
    public function setQuantity(int $quantity): Vegetable;
}
