<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Percas\Core\Controller\AbstractLayoutController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractLayoutController
{
    /**
     * @Route("")
     */
    public function index(): Response
    {
        return $this->render('modules/system/module.html.twig');
    }
}
