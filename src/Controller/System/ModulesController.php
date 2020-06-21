<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractController
{
    /**
     * @Route("", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function grid(Request $request): Response
    {
        $data = [];
        $data['headers'] = [
            ['text' => 'Name', 'value' => 'name'],
            ['text' => 'Link', 'value' => 'link'],
            ['text' => '', 'value' => 'actions', 'width' => 100, 'sortable' => false],
        ];
        if ($request->isMethod('POST')) {
            $data['filters'] = json_decode($request->getContent(), true)['filters'];
        } else {
            $data['filters'] = [
                ['type' => 'text', 'key' => 'name', 'name' => 'Name', 'icon' => 'mdi-tag', 'value' => '', 'col' => 4],
                ['type' => 'text', 'key' => 'link', 'name' => 'Link', 'icon' => 'mdi-tag', 'value' => '', 'col' => 4],
            ];
        }
        $data['rows'] = [];

        for ($i = 1; $i <= 10; $i++) {
            $data['rows'][] = [
                'id' => ['type' => 'hidden', 'value' => $i],
                'name' => ['type' => 'text', 'value' => 'Module ' . $i],
                'link' => ['type' => 'text', 'value' => '/module-' . $i],
                'actions' => [
                    'type' => 'actions',
                    'value' => [
                        ['key' => 'edit', 'name' => 'Edit', 'icon' => 'mdi-pencil'],
                        ['key' => 'delete', 'name' => 'Delete', 'icon' => 'mdi-delete']
                    ],
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
    public function form(int $id): Response
    {
        $data = [];
        $data['fields'] = [
            'name' => ['type' => 'text', 'key' => 'name', 'name' => 'Name', 'icon' => 'mdi-tag', 'value' => 'Module ' . $id],
            'link' => ['type' => 'text', 'key' => 'link', 'name' => 'Link', 'icon' => 'mdi-tag', 'value' => '/module-' . $id],
        ];
        $data['buttons'] = [
            'save' => ['key' => 'save', 'name' => 'Save', 'icon' => 'mdi-content-save', 'color' => 'primary', 'outlined' => false],
            'cancel' => ['key' => 'cancel', 'name' => 'Canel', 'icon' => 'mdi-cancel', 'color' => 'default', 'outlined' => true],
        ];
        return $this->json($data);
    }

    /**
     * @Route("/{id}", methods={"POST"})
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function formSubmit(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);
        return $this->json($data);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     * @param int $id
     * @return Response
     */
    public function formDelete(int $id): Response
    {
        return $this->json(['action' => 'delete', 'id' => $id]);
    }
}
