<?php

namespace App\Tests\App\Application\Vegetable;

use App\Application\Vegetable\RemoveVegetable;
use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;
use PHPUnit\Framework\TestCase;

class RemoveVegetableTest extends TestCase
{
    /** @test */
    public function shouldRemoveAVegetable()
    {
        $vegetablesRepository = $this->createMock(VegetablesRepository::class);

        $vegetable = (new Vegetable())
            ->setId(8);

        $vegetablesRepository
            ->expects($this->once())
            ->method('search')
            ->with(8)
            ->willReturn($vegetable);
        
        $vegetablesRepository
            ->expects($this->once())
            ->method('remove')
            ->with($vegetable);
        
        $removeVegetable = new RemoveVegetable($vegetablesRepository);
        $removeVegetable->__invoke(8);
    }
}