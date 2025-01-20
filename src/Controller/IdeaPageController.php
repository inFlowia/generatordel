<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constants\Message;
use App\Constants\ResponseKey;
use App\Exception\NotFoundException;
use App\Helper\JsonResponseFactory;
use App\ResponseDataCreator\IdeaPageCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** ЭП: Страница с данными идеи */
class IdeaPageController
{
    #[Route(
        path   : '/idea/{id}',
        name   : 'idea_page',
        methods: ['GET']
    )]
    public function __invoke(
        IdeaPageCreator     $responseDataCreator,
        JsonResponseFactory $jsonResponseFactory,
        int                 $id,
    ): JsonResponse {
        try {
            $jsonResponse = $jsonResponseFactory->create(
                $responseDataCreator($id),
                Response::HTTP_OK
            );
        } catch (NotFoundException $exception) {
            $jsonResponse = $jsonResponseFactory->create(
                [ResponseKey::ERROR => Message::IDEA_NOT_FOUND],
                Response::HTTP_NOT_FOUND
            );
            // todo: добавить логирование исключения
        } catch (\Throwable $exception) {
            $jsonResponse = $jsonResponseFactory->create(
                [ResponseKey::ERROR => Message::ERROR_GENERAL_MESSAGE],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
            // todo: добавить логирование исключения
        }

        return $jsonResponse;
    }
}
