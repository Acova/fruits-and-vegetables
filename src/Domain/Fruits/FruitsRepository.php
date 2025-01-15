<?php

namespace App\Domain\Fruits;

interface FruitsRepository
{
    public function add(Fruit $fruit): void;
    public function remove(Fruit $fruit): void;
    public function update(Fruit $fruit): void;
    public function list(array $filter = []): array;
    public function search(int $id): ?Fruit;
}