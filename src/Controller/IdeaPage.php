<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constants\Message;
use App\Helper\JsonResponseFactory;
use App\ResponseDataCreator\IdeaPageCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** ЭП: Страница с данными идеи */
class IdeaPage
{
    #[Route(
        path   : '/idea/{id}',
        name   : 'idea_page',
        methods: ['GET']
    )]
    public function __invoke(
        IdeaPageCreator     $responseDataCreator,
        JsonResponseFactory $jsonResponseFactory,
        ?int                $id = null,
    ): JsonResponse {
        try {
            $jsonResponse = $jsonResponseFactory->create(
                $responseDataCreator($id),
                Response::HTTP_OK
            );
        } catch (\Throwable $exception) {
            $jsonResponse = $jsonResponseFactory->create(
                ['error' => Message::IDEA_NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
            // todo: добавить логирование исключения
        }

        return $jsonResponse;
    }
}
