<?php

declare(strict_types=1);


namespace Percas\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Percas\Entity\Admin\Module;
use Percas\Entity\Admin\User;
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

    /**
     * @Route("/modules")
     */
    public function modules(EntityManagerInterface $em)
    {
        /** @var User $user */
        $user = $this->getUser();
        $roles = [];

        foreach ($user->getUserRoles() as $role) {
            $roles[] = $role->getRole();
        }

        $modules = $em->getRepository(Module::class)->findAllAccessibleModulesByRoles($roles);
        dump($modules);

        foreach ($modules as $module) {
            /** @var Module $module */
            dump($module->getApplications());
        }


        return $this->render('base.html.twig');
    }
}
