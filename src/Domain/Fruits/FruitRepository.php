<?php

namespace App\Domain\Fruits;

interface FruitRepository
{
    public function add(Fruit $fruit): void;
    public function remove(Fruit $fruit): void;
    public function update(Fruit $fruit): void;
    public function list(): array;
    public function search(): ?Fruit;
}