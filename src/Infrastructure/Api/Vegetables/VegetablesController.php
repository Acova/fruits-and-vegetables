<?php

namespace App\Infrastructure\Api\Vegetables;

use App\Application\Vegetable\CreateVegetable;
use App\Application\Vegetable\ListVegetables;
use App\Application\Vegetable\RemoveVegetable;
use App\Application\Vegetable\ShowVegetable;
use App\Application\Vegetable\VegetableDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/vegetable')]
class VegetablesController extends AbstractController
{
    #[Route(
        path: '',
        name: 'index_vegetable',
        methods: [Request::METHOD_GET]
    )]
    public function list(
        ListVegetables $listVegetables,
        Request $request
    ): Response {
        $filter = [];
        if (null !== $request->get('unit')){
            $filter['unit'] = $request->get('unit');
        }
        return $this->json($listVegetables->__invoke($filter));
    }

    #[Route(
        path: '/{id}',
        name: 'show_vegetable',
        methods: [Request::METHOD_GET]
    )]
    public function show(
        ShowVegetable $showVegetable,
        Request $request,
        int $id
    ): Response {
        $options = [];
        if (null !== $request->get('unit')) {
            $options['unit'] = $request->get('unit');
        }
        return $this->json($showVegetable->__invoke($id, $options));
    }

    #[Route(
        path: '',
        name: 'create_vegetable',
        methods: [Request::METHOD_POST]
    )]
    public function create(
        CreateVegetable $createVegetable,
        Request $request
    ): Response {
        $jsonData = json_decode($request->getContent(), true);
        $createVegetable->__invoke(new VegetableDTO(
            $jsonData['id'],
            $jsonData['name'],
            $jsonData['quantity']
        ));
        
        return new Response('', Response::HTTP_CREATED);
    }

    #[Route(
        path: '/{id}',
        name: 'remove_vegetable',
        methods: [Request::METHOD_DELETE]
    )]
    public function remove(
        RemoveVegetable $removeVegetable,
        int $id
    ): Response {
        $removeVegetable->__invoke($id);
        
        return new Response('', Response::HTTP_NO_CONTENT);
    }    
}