<?php

namespace App\Tests\App\Application\Fruit;

use App\Application\Fruit\ShowFruit;
use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;
use PHPUnit\Framework\TestCase;

class ShowFruitTest extends TestCase
{
    /** @test */
    public function shouldReturnAnArrayOfFruits()
    {
        $fruitRepository = $this->createMock(FruitsRepository::class);

        $fruitRepository
            ->expects($this->once())
            ->method('search')
            ->with(6)
            ->willReturn((new Fruit()));
        
        $showFruit = new ShowFruit($fruitRepository);
        $showFruit->__invoke(6);
    }
}