<?php

declare(strict_types=1);


namespace Percas\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->json(['admin + modules']);
    }
}
