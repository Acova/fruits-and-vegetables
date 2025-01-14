<?php

namespace App\Domain;

use App\Domain\Fruits\Fruit;
use App\Domain\Fruits\FruitsRepository;
use App\Domain\Vegetables\Vegetable;
use App\Domain\Vegetables\VegetablesRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function PHPSTORM_META\map;

#[AsCommand(name: 'app:load-data-from-file')]
class LoadDataFromFile extends Command
{
    public function __construct(
        private FruitsRepository $fruitsRepository,
        private VegetablesRepository $vegetablesRepository
    ) {  
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Searches for the request.json file and loads it\'s contents')
            ->setHelp('The file will be deleted after being load');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!file_exists('/app/request.json')) {
            return Command::SUCCESS;
        }

        $contents = file_get_contents('/app/request.json');
        if (!$contents) {
            return Command::FAILURE;
        }

        $data = json_decode($contents, true);
        $failedElements = [];

        foreach($data as $item){
            if (
                is_null($item['id'])
                || is_null($item['name'])
                || is_null($item['type'])
                || is_null($item['quantity'])
                || is_null($item['unit'])
            ) {
                $item['error'] = 'This item doesn\'t include all the required fields';
                $failedElements[] = $item;
                continue;
            }

            $newElement = null;
            if ('vegetable' === $item['type']) {
                $newElement = new Vegetable();
            } elseif ('fruit' === $item['type']) {
                $newElement = new Fruit();
            } else {
                $item['error'] = 'This \'type\' is not correct';
                $failedElements[] = $item;
                continue;
            }

            if (!is_int($item['id'])) {
                $item['error'] = 'This item\'s id is not a number';
                $failedElements[] = $item;
                continue;
            }
            $newElement->setId($item['id']);

            if (!is_int($item['quantity'])) {
                $item['error'] = 'This item\'s quantity is not a number';
                $failedElements[] = $item;
                continue;
            }

            if ('g' === $item['unit']) {
                $newElement->setQuantity($item['quantity']);
            } elseif ('kg' === $item['unit']) {
                $newElement->setQuantity($item['quantity'] * 1000);
            } else {
                $item['error'] = 'This item\'s unit is not correct!';
                $failedElements[] = $item;
                continue;
            }
            $newElement->setName($item['name']);

            if ($newElement instanceof Vegetable) {
                $this->vegetablesRepository->add($newElement);
            } else {
                $this->fruitsRepository->add($newElement);
            }
        }

        unlink('/app/request.json');
        file_put_contents('/app/request_errors.json', json_encode($failedElements));
        return Command::SUCCESS;
    }
}