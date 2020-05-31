<?php

declare(strict_types=1);


namespace Percas\Module\System\Modules;


use Doctrine\ORM\EntityManagerInterface;
use Percas\Core\Component\Form\DataSource\DoctrineDataSource;
use Percas\Core\Component\Form\Form;
use Percas\Core\Component\Form\FormBuilder;
use Percas\Core\Component\Form\Response;
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
        $builder = new FormBuilder(new DoctrineDataSource($this->em, Module::class), $id);

        $builder->addTextField('name', 'Name');
        $builder->addTextField('link', 'Link');

        $builder->addSaveAction();
        $builder->addCloseAction();

        return $builder->build();
    }

    public function handleSubmit(Form $form): Response\ResponseInterface
    {
        try {
            $form->handleSubmit();
            return new Response\Success();
        } catch (\Exception $e) {
            return new Response\Error($e->getMessage());
        }
    }
}
