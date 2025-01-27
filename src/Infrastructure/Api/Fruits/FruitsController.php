<?php

namespace App\Infrastructure\Api\Fruits;

use App\Application\Fruit\CreateFruit;
use App\Application\Fruit\FruitDTO;
use App\Application\Fruit\ListFruits;
use App\Application\Fruit\RemoveFruit;
use App\Application\Fruit\ShowFruit;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/fruit')]
class FruitsController extends AbstractController
{
    #[Route(
        path: '',
        name: 'index_fruit',
        methods: [Request::METHOD_GET]
    )]
    public function list(
        ListFruits $listFruits,
        Request $request
    ): Response {
        $filter = [];
        if (null !== $request->get('unit')) {
            $filter['unit'] = $request->get('unit');
        }

        return $this->json($listFruits->__invoke($filter));
    }

    #[Route(
        path: '/{id}',
        name: 'show_fruit',
        methods: [Request::METHOD_GET]
    )]
    public function show(
        ShowFruit $showFruit,
        Request $request,
        int $id
    ): Response {
        $options = [];
        if (null !== $request->get('unit')) {
            $options['unit'] = $request->get('unit');
        }
        return $this->json($showFruit->__invoke($id, $options));
    }

    #[Route(
        path: '',
        name: 'create_fruit',
        methods: [Request::METHOD_POST]
    )]
    public function create(
        CreateFruit $createFruit,
        Request $request
    ): Response {
        $jsonData = json_decode($request->getContent(), true);
        $createFruit->__invoke(new FruitDTO(
            $jsonData['id'],
            $jsonData['name'],
            $jsonData['quantity']
        ));
        
        return new Response('', Response::HTTP_CREATED);
    }

    #[Route(
        path: '/{id}',
        name: 'remove_fruit',
        methods: [Request::METHOD_DELETE]
    )]
    public function remove(
        RemoveFruit $removeFruit,
        int $id
    ): Response {
        $removeFruit->__invoke($id);
        
        return new Response('', Response::HTTP_NO_CONTENT);
    }
}