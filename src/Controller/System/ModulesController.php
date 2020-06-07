<?php

declare(strict_types=1);


namespace Percas\Controller\System;

use Percas\Core\Component\Grid\Renderer as GridRenderer;
use Percas\Module\System\Modules\ModulesForm;
use Percas\Module\System\Modules\ModulesGrid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/modules")
 */
class ModulesController extends AbstractController
{
    /**
     * @Route("", methods={"GET"})
     * @param ModulesGrid $gridComponent
     * @return Response
     */
    public function grid(ModulesGrid $gridComponent): Response
    {
        $grid = $gridComponent->create();
        $renderer = new GridRenderer\JsonRenderer();
        return new Response($renderer->render($grid));
    }

    /**
     * @Route("/{id}")
     * @param ModulesForm $formComponent
     * @param int $id
     * @return Response
     */
    public function form(ModulesForm $formComponent, int $id): Response
    {
        $form = $formComponent->create($id);
        dd($form);
    }

//    /**
//     * @Route("/form2/{id}")
//     * @param EntityManagerInterface $em
//     * @param int $id
//     * @return Response
//     */
//    public function form2(EntityManagerInterface $em, int $id): Response
//    {
//        $builder = new FormBuilder($em->find(Module::class, $id));
//
//        $field = new Field('name', 'Name');
//        $builder->addField($field);
//
//        $field = new Field('link', 'Link');
//        $field->addConstraint(new NotBlank());
//        $builder->addField($field);
//
//        $action = new Action('save', 'Save', $this->saveActionHandler($em));
//
//        $builder->addAction($action);
//
//        $form = $builder->build();
//
//        $form->handleSubmit();
//
//        $renderer = new Renderer();
//        $renderer->render($form);
//    }
//
//    private function saveActionHandler(EntityManagerInterface $em): callable
//    {
//        return static function (Form $form) use ($em) {
//            /** @var Module $module */
//            $module = $form->getData();
//            $em->persist($module);
//            $em->flush();
//        };
//    }
}
