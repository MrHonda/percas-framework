<?php

namespace Percas\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     * @return Response
     */
    public function login(): Response
    {
        if ($this->getUser()) {
            return $this->json('success');
        }

        return $this->json([]);
    }

    /**
     * @Route("/logout")
     */
    public function logout(): void
    {
    }
}
