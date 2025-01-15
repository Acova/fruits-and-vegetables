<?php

namespace App\Tests\App\Application\Vegetable;

use App\Application\Vegetable\CreateVegetable;
use App\Application\Vegetable\VegetableDTO;
use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;
use PHPUnit\Framework\TestCase;

class CreateVegetableTest extends TestCase
{
    /** @test */
    public function shouldAddVegetableToDatabase()
    {
        $vegetablesRepository = $this->createMock(VegetablesRepository::class);
        $vegetableDTO = new VegetableDTO(1, 'Lorem', 5);

        $vegetablesRepository
            ->expects($this->once())
            ->method('add')
            ->with($this->callback(
                function(Vegetable $vegetable) {
                    return 1 === $vegetable->getId()
                        && 'Lorem' === $vegetable->getName()
                        && 5 === $vegetable->getQuantity();
                }
            ));
        
        $createVegetable = new CreateVegetable($vegetablesRepository);
        $createVegetable->__invoke($vegetableDTO);
    }
}