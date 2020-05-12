<?php

declare(strict_types=1);


namespace Percas\Core\Security\Subscriber;

use Doctrine\ORM\EntityManagerInterface;
use Percas\Core\Controller\AbstractFrameworkController;
use Percas\Core\Security\Autherization\AutherizationCheckerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AutherizationSubscriber implements EventSubscriberInterface
{
    /**
     * @var AutherizationCheckerInterface
     */
    private $autherizationChecker;

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
//            KernelEvents::CONTROLLER => [
//                ['processAutherization', 0]
//            ]
        ];
    }

    /**
     * AutherizationSubscriber constructor.
     * @param EntityManagerInterface $em
     * @param AutherizationCheckerInterface $autherizationChecker
     */
    public function __construct(EntityManagerInterface $em, AutherizationCheckerInterface $autherizationChecker)
    {
        $this->autherizationChecker = $autherizationChecker;
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

        $this->autherizationChecker->denyUnlessGranted('access');
    }
}
