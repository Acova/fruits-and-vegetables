<?php

namespace App\Application\Vegetable;

use App\Domain\Vegetables\VegetablesRepository;

class RemoveVegetable
{
    public function __construct(
        private VegetablesRepository $vegetablesRepository
    ) {
    }

    public function __invoke(int $id)
    {
        $vegetable = $this->vegetablesRepository->search($id);
        $this->vegetablesRepository->remove($vegetable);
    }
}