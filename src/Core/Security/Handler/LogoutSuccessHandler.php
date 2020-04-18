<?php

declare(strict_types=1);


namespace Percas\Core\Security\Handler;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;

class LogoutSuccessHandler implements LogoutSuccessHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function onLogoutSuccess(Request $request): Response
    {
        return new JsonResponse('success');
    }
}
