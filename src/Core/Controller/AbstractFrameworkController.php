<?php

declare(strict_types=1);


namespace Percas\Core\Controller;


use Percas\Core\Layout\LayoutInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class AbstractFrameworkController extends AbstractController
{
    /**
     * @var LayoutInterface|null
     */
    protected $layout;

    /**
     * @param LayoutInterface|null $layout
     */
    public function __construct(?LayoutInterface $layout = null)
    {
        $this->layout = $layout;
    }

    /**
     * @param string $view
     * @param array $paramenters
     * @return Response
     */
    protected function renderLayout(string $view, array $paramenters = []): Response
    {
        $paramenters['layout'] = $this->layout;
        return $this->render($view, $paramenters);
    }
}
