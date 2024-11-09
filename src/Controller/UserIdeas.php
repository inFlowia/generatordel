<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message;
use App\Responder\UserIdeasResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/** ЭП: компонент с идеями пользователя */
class UserIdeas
{
    #[Route(path: '/user-ideas/{login}', name: 'user_ideas', methods: ['GET'], options: ['expose' => true])]
    public function __invoke(
        Request $request,
        UserIdeasResponder $responder,
        ?string $login = null,
    ): JsonResponse {
        try {
            return new JsonResponse(
                $responder(
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
