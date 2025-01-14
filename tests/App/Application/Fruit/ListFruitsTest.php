<?php

namespace Test\App\Application\Fruit;

use App\Application\Fruit\ListFruits;
use App\Domain\Fruits\FruitsRepository;
use PHPUnit\Framework\TestCase;

class ListFruitsTest extends TestCase
{
    /** @test */
    public function shouldReturnAnArrayOfFruits()
    {
        $fruitRepository = $this->createMock(FruitsRepository::class);

        $fruitRepository
            ->expects($this->once())
            ->method('list')
            ->willReturn([]);
        
        $listFruits = new ListFruits($fruitRepository);
        $listFruits->__invoke();
    }
}