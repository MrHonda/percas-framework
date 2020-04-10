<?php

declare(strict_types=1);


namespace Percas\Controller\Admin;

use Percas\Core\Controller\AbstractLayoutController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users")
 */
class UsersController extends AbstractLayoutController
{
    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->renderLayout('modules/admin/admin.html.twig');
    }
}
