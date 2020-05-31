<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Percas\Core\Component\Form\Renderer as FormRenderer;
use Percas\Core\Component\Grid\Renderer as GridRenderer;
use Percas\Module\System\Modules\ModulesForm;
use Percas\Module\System\Modules\ModulesGrid;
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
     * @param ModulesGrid $gridComponent
     * @return Response
     */
    public function grid(ModulesGrid $gridComponent): Response
    {
        $grid = $gridComponent->create();
        $renderer = new GridRenderer\JsonRenderer();
        return new Response($renderer->render($grid));
    }

    /**
     * @Route("/{id}")
     * @param ModulesForm $formComponent
     * @param int $id
     * @return Response
     */
    public function form(ModulesForm $formComponent, int $id): Response
    {
        $form = $formComponent->create($id);
        $renderer = new FormRenderer\ArrayRenderer();

        if ($form->isSubmitted()) {
            $response = $formComponent->handleSubmit($form);
            return $this->json($renderer->renderResponse($response), $response->getCode());
        }

        return $this->json($renderer->render($form));
    }
}
