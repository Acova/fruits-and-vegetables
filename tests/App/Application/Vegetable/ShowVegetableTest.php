<?php

namespace App\Tests\App\Application\Vegetable;

use App\Application\Vegetable\RemoveVegetable;
use App\Application\Vegetable\ShowVegetable;
use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;
use PHPUnit\Framework\TestCase;

class ShowVegetableTest extends TestCase
{
    /** @test */
    public function shouldReturnAVegetable()
    {
        $vegetablesRepository = $this->createMock(VegetablesRepository::class);

        $vegetable = (new Vegetable())
            ->setId(8);

        $vegetablesRepository
            ->expects($this->once())
            ->method('search')
            ->with(8)
            ->willReturn($vegetable);
        
        $showVegetable = new ShowVegetable($vegetablesRepository);
        $showVegetable->__invoke(8);
    }
}