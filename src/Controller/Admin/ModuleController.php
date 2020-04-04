<?php

declare(strict_types=1);


namespace Percas\Controller\Admin;

use Percas\Core\Controller\AbstractLayoutController;
use Percas\Core\Layout\DefaultLayout;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractLayoutController
{
    /**
     * @param DefaultLayout $layout
     */
    public function __construct(DefaultLayout $layout)
    {
        parent::__construct($layout);
    }

    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->renderLayout('modules/admin/admin.html.twig');
    }
}
