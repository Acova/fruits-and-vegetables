<?php

namespace App\Tests\App\Infrastructure\Command;

use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;
use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;
use App\Infrastructure\Command\LoadDataFromFileCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class LoadDataFromFileCommandTest extends KernelTestCase
{
    /** @test */
    public function shouldDoNothingIfFileDoesNotExist()
    {
        $fruitsRepository = $this->createMock(FruitsRepository::class);
        $fruitsRepository
            ->expects($this->never())
            ->method('add');
        $vegetablesRepository = $this->createMock(VegetablesRepository::class);
        $vegetablesRepository
            ->expects($this->never())
            ->method('add');

        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new LoadDataFromFileCommand($fruitsRepository, $vegetablesRepository));

        $command = $application->find('app:load-data-from-file');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'file-path' => '/app/tests/App/Infrastructure/not-existing-file.json'
        ]);
        $commandTester->assertCommandIsSuccessful();
    }

    /** @test */
    public function shouldCreateNewFruitsAndVegetablesWriteErrorsAndRemoveFile()
    {
        $testContent = [
            [
                'id' => 1,
                'name' => 'Carrot',
                'type' => 'vegetable',
                'quantity' => 100000,
                'unit' => 'g'
            ],
            [
                'id' => 2
            ],
            [
                'id' => 3,
                'name' => 'Pears',
                'type' => 'fruit',
                'quantity' => 50,
                'unit' => 'kg'
            ],
            [
                'id' => 4,
                'name' => 'Pork',
                'type' => 'meat',
                'quantity' => 10,
                'unit' => 'kg'
            ]
        ];

        file_put_contents(__DIR__.'/test.json', json_encode($testContent));
        $fruitsRepository = $this->createMock(FruitsRepository::class);
        $fruitsRepository
            ->expects($this->once())
            ->method('add')
            ->with($this->callback(
                function(Fruit $fruit) {
                    return 3 === $fruit->getId()
                        && 'Pears' === $fruit->getName()
                        && 50000 === $fruit->getQuantity();
                }
            ));
        $vegetablesRepository = $this->createMock(VegetablesRepository::class);
        $vegetablesRepository
            ->expects($this->once())
            ->method('add')
            ->with($this->callback(
                function(Vegetable $vegetable) {
                    return 1 === $vegetable->getId()
                        && 'Carrot' === $vegetable->getName()
                        && 100000 === $vegetable->getQuantity();
                }
            ));

        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new LoadDataFromFileCommand($fruitsRepository, $vegetablesRepository));

        $command = $application->find('app:load-data-from-file');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'file-path' => '/app/tests/App/Infrastructure/Command/test.json'
        ]);
        $commandTester->assertCommandIsSuccessful();

        $this->assertTrue(file_exists('/app/request_errors.json'));
    }
}