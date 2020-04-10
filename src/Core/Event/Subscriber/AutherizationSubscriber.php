<?php

declare(strict_types=1);


namespace Percas\Core\Event\Subscriber;

use Doctrine\ORM\EntityManagerInterface;
use Percas\Core\Controller\AbstractFrameworkController;
use Percas\Core\Security\Autherization\AutherizationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AutherizationSubscriber implements EventSubscriberInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => [
                ['processAutherization', 0]
            ]
        ];
    }

    /**
     * AutherizationSubscriber constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processAutherization(ControllerEvent $event): void
    {
        $eventController = $event->getController();

        if (!is_array($eventController)) {
            return;
        }

        $controller = $eventController[0];

        if (!$controller instanceof AbstractFrameworkController) {
            return;
        }

        $authenticationService = new AutherizationService($this->em, $controller->getUser(), $event->getRequest()->getPathInfo());

        $authenticationService->denyUnlessGranted('access');
    }
}
