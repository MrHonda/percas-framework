<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Percas\Core\Controller\AbstractLayoutController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractLayoutController
{

    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('modules/admin/admin.html.twig');
    }
}
