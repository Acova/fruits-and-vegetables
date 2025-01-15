<?php

namespace App\Tests\App\Application\Vegetable;

use App\Application\Vegetable\ListVegetables;
use App\Domain\Vegetables\VegetablesRepository;
use PHPUnit\Framework\TestCase;

class ListVegetablesTest extends TestCase
{
    /** @test */
    public function shouldReturnAListOfVegetables()
    {
        $vegetablesRepository = $this->createMock(VegetablesRepository::class);

        $vegetablesRepository
            ->expects($this->once())
            ->method('list')
            ->willReturn([]);
        
        $listVegetables = new ListVegetables($vegetablesRepository);
        $listVegetables->__invoke();
    }
}