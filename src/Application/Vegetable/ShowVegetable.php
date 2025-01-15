<?php

namespace App\Application\Vegetable;

use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;

class ShowVegetable
{
    public function __construct(
        private VegetablesRepository $vegetablesRepository
    ) {
    }

    public function __invoke(int $id, array $options = [])
    {
        /** @var Vegetable */
        $vegetable = $this->vegetablesRepository->search($id);
        if (isset($options['unit']) && 'kg' === $options['unit']) {
            $vegetable->setQuantity($vegetable->getQuantity() / 1000);
        }

        return $vegetable;
    }
}