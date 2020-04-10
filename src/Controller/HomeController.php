<?php

declare(strict_types=1);


namespace Percas\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     * @return Response
     */
    public function index(): Response
    {
        return $this->redirectToRoute('percas_system_module_index');
    }
}
