<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message;
use App\ResponseDataCreator\UserIdeasComponentCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** ЭП: компонент с идеями пользователя */
class UserIdeasComponent
{
    #[Route(
        path   : '/component/user-ideas/{login}',
        name   : 'user_ideas_component',
        methods: ['GET']
    )]
    public function __invoke(
        Request                   $request,
        UserIdeasComponentCreator $responseDataCreator,
        ?string                   $login = null,
    ): JsonResponse {
        try {
            return new JsonResponse(
                $responseDataCreator(
                    $login,
                    $request->query->getInt('limit'),
                    $request->query->getInt('offset'),
                ),
                Response::HTTP_OK
            );
        } catch (\Throwable $exception) {
            return new JsonResponse(
                ['error' => Message::USER_IDEAS_GETTING_ERROR],
                Response::HTTP_NOT_FOUND
            );
            // todo: добавить логирование исключения
        }
    }
}
