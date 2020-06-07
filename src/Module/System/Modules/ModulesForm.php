<?php

declare(strict_types=1);


namespace Percas\Module\System\Modules;


use Doctrine\ORM\EntityManagerInterface;
use Percas\Core\Component\Form\Form;
use Percas\Core\Component\Form\FormBuilder;
use Percas\Entity\System\Module;


class ModulesForm
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ModulesForm constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function create(int $id): Form
    {
        /** @var Module $module */
        $module = $this->em->find(Module::class, $id);
        $builder = new FormBuilder($module);

        $builder->addTextField('name', 'Name');
        $builder->addTextField('link', 'Link');

        $builder->addSaveButton($this->saveHandler());
        $builder->addCancelButton();

        $form = $builder->build();
        $form->handleSubmit();

        return $form;
    }

    private function saveHandler(): callable
    {
        $em = $this->em;
        return static function (Form $form) use ($em) {
//            dd($form->getData());
            $em->persist($form->getData());
            $em->flush();
        };
    }
}
