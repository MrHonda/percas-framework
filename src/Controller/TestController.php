<?php

declare(strict_types=1);


namespace Percas\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/doctrine")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function doctrine(EntityManagerInterface $em): Response
    {
//        $user = new User();
//        $user
//            ->setUsername('test')
//            ->setPassword('test');
//
//        $role = new Role();
//        $role
//            ->setName('test1');
//
//        $userRole = new UserRole();
//        $userRole
//            ->setUser($user)
//            ->setRole($role)
//            ->setIsMain(true);
//
//        $em->persist($userRole);
//        $em->flush();

//        $user = $em->find(User::class, 3);
//        $roles = [];
//        foreach ($user->getUserRoles() as $userRole) {
//            $roles[] = $userRole->getRole()->getName();
//        }

//        dd($roles);
//        $em->remove($user);
//        $em->flush();

        return $this->json(['doctrine']);
    }
}
