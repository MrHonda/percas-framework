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
        $user = $this->getUser();
        if ($user) {
            $userArray = [
                'username' => $user->getUsername(),
            ];
            return $this->json(['user' => $userArray]);
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
