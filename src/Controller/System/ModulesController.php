<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Percas\Core\Controller\AbstractLayoutController;
use Percas\Module\System\Module\ModulesGrid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractLayoutController
{
    /**
     * @Route("/")
     * @param ModulesGrid $grid
     * @return Response
     */
    public function index(ModulesGrid $grid): Response
    {
        return $this->render('modules/system/modules/index.html.twig', [
            'grid' => $grid->create()
        ]);
    }
}
