<?php

declare(strict_types=1);


namespace Percas\Core\Controller;

use Percas\Core\Security\Autherization\AutherizationCheckerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractFrameworkController extends AbstractController
{
    /**
     * @var AutherizationCheckerInterface
     */
    protected $authorizationChecker;

    /**
     * AbstractFrameworkController constructor.
     * @param AutherizationCheckerInterface $authorizationChecker
     */
    public function __construct(AutherizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }
}
