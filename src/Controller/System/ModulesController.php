<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     * @return Response
     */
    public function list(): Response
    {
        $data = [];
        $data['headers'] = [
            ['key' => 'col1', 'text' => 'Column 1'],
            ['key' => 'col2', 'text' => 'Column 2'],
            ['key' => 'col3', 'text' => 'Column 3'],
        ];
        $data['rows'] = [];

        for ($i = 1; $i <= 5; $i++) {
            $data['rows'][] = [
                'id' => $i,
                'columns' => [
                    ['key' => 'col1', 'value' => 'Value ' . $i . '.1'],
                    ['key' => 'col2', 'value' => 'Value ' . $i . '.2'],
                    ['key' => 'col3', 'value' => 'Value ' . $i . '.3'],
                ],
                'actions' => [
                    ['key' => 'edit', 'text' => 'Edit'],
                    ['key' => 'delete', 'text' => 'Delete'],
                ]
            ];
        }
        return $this->json($data);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     * @param int $id
     * @return Response
     */
    public function item(int $id): Response
    {
        $data = [];
        $data['fields'] = [];
        $data['actions'] = [];

        for ($i = 1; $i <= 3; $i++) {
            $data['fields'][] = ['name' => 'col' . $i, 'text' => 'Column ' . $i, 'value' => 'Value ' . $id . '.' . $i];
        }

        $data['actions'] = [
            ['name' => 'save', 'text' => 'Save'],
            ['name' => 'close', 'text' => 'Close'],
        ];

        return $this->json($data);
    }

    /**
     * @Route("", methods={"POST"})
     * @return Response
     */
    public function create(): Response
    {
        $result = ['success' => true];
        return $this->json($result);
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     * @param int $id
     * @return Response
     */
    public function update(int $id): Response
    {
        $result = ['success' => true, 'action' => 'update'];
        return $this->json($result);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $result = ['success' => true, 'action' => 'delete'];
        return $this->json($result);
    }
}
