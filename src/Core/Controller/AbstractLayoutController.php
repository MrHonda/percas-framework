<?php

declare(strict_types=1);


namespace Percas\Core\Controller;

use Percas\Core\Layout\LayoutInterface;
use Percas\Core\Security\Autherization\AutherizationCheckerInterface;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractLayoutController extends AbstractFrameworkController
{
    /**
     * @var LayoutInterface
     */
    protected $layout;

    /**
     * @param AutherizationCheckerInterface $autherizationChecker
     * @param LayoutInterface $layout
     */
    public function __construct(AutherizationCheckerInterface $autherizationChecker, LayoutInterface $layout)
    {
        parent::__construct($autherizationChecker);
        $this->layout = $layout;
    }

    /**
     * @inheritDoc
     */
    protected function render(string $view, array $parameters = [], Response $response = null): Response
    {
        $parameters['layout'] = $this->layout;
        return parent::render($view, $parameters, $response);
    }
}
