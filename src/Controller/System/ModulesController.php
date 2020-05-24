<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Percas\Core\Component\Grid\Renderer\JsonRenderer;
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
        $renderer = new JsonRenderer();
        return new Response($renderer->render($grid));
    }
}
