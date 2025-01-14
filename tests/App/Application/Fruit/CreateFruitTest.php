<?php

namespace Test\App\Application\Fruit;

use App\Application\Fruit\CreateFruit;
use App\Application\Fruit\FruitDTO;
use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;
use PHPUnit\Framework\TestCase;

class CreateFruitTest extends TestCase
{
    /** @test */
    public function shouldAddFruitToDatabase()
    {
        $fruitRepository = $this->createMock(FruitsRepository::class);
        $fruitDTO = new FruitDTO(1, 'Lorem', 5);

        $fruitRepository
            ->expects($this->once())
            ->method('add')
            ->with($this->callback(
                function(Fruit $fruit) {
                    return 1 === $fruit->getId()
                        && 'Lorem' === $fruit->getName()
                        && 5 === $fruit->getQuantity();
                }
            ));
        
        $createFruit = new CreateFruit($fruitRepository);
        $createFruit->__invoke($fruitDTO);
    }
}