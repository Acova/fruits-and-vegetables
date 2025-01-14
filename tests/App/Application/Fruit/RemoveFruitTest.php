<?php

namespace Test\App\Application\Fruit;

use App\Application\Fruit\RemoveFruit;
use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;
use PHPUnit\Framework\TestCase;

class RemoveFruitTest extends TestCase
{
    /** @test */
    public function shouldRemoveAFruit()
    {
        $fruitRepository = $this->createMock(FruitsRepository::class);

        $fruit = (new Fruit)
            ->setId(5)
            ->setName('Ipsum')
            ->setQuantity(20);

        $fruitRepository
            ->expects($this->once())
            ->method('search')
            ->with(5)
            ->willReturn($fruit);
        
        $fruitRepository
            ->expects($this->once())
            ->method('remove')
            ->with($fruit);
        
        $removeFruit = new RemoveFruit($fruitRepository);
        $removeFruit->__invoke(5);
    }
}