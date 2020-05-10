<?php

declare(strict_types=1);


namespace Percas\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Percas\Entity\System\Module;
use Percas\Entity\System\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/framework")
 */
class FrameworkController extends AbstractController
{
    /**
     * @Route("/initialize")
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function initialize(EntityManagerInterface $em): JsonResponse
    {
        /** @var User $user */
        $user = $this->getUser();
        $modules =  $em->getRepository(Module::class)->findAllAccessibleByRoles($user->getAllRoles());
        dd($modules);
    }
}
