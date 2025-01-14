<?php

namespace App\Infrastructure\HttpController\Fruits;

use App\Domain\Fruits\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/fruit')]
class FruitsHttpController extends AbstractController
{
    #[Route(
        path: '',
        name: 'index_fruit',
        methods: [Request::METHOD_GET]
    )]
    public function list(
        FruitRepository $fruitRepository,
        Request $request
    ): Response {
        return new Response();
    }
}