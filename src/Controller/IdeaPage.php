<?php

declare(strict_types=1);

namespace App\Controller;

use App\Message;
use App\Responder\IdeaPageResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** ЭП: Страница с данными идеи */
class IdeaPage
{
    #[Route(
        path: '/idea/{id}',
        name: 'idea_page',
        methods: ['GET']
    )]
    public function __invoke(
        IdeaPageResponder $responder,
        ?int              $id = null
    ): JsonResponse {
        try {
            return new JsonResponse($responder($id), Response::HTTP_OK);
        } catch (\Throwable $exception) {
            return new JsonResponse(
                ['error' => Message::IDEA_NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
            // todo: добавить логирование исключения
        }
    }
}
