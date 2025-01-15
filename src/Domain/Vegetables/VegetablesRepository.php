<?php

namespace App\Domain\Vegetables;

interface VegetablesRepository
{
    public function add(Vegetable $fruit): void;
    public function remove(Vegetable $fruit): void;
    public function update(Vegetable $fruit): void;
    public function list(array $filter = []): array;
    public function search(int $id): ?Vegetable;
}