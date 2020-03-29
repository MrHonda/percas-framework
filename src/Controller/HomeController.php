<?php

declare(strict_types=1);


namespace Percas\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("")
     */
    public function index()
    {
        return $this->json(['home']);
    }
}
