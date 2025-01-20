<?php

declare(strict_types=1);

namespace App\Controller;

use App\Constants\Message;
use App\Constants\ResponseKey;
use App\Exception\NotFoundException;
use App\Helper\JsonResponseFactory;
use App\ResponseDataCreator\UserIdeasComponentCreator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/** ЭП: компонент с идеями пользователя */
class UserIdeasComponentController
{
    #[Route(
        path   : '/component/user-ideas/{login}',
        name   : 'user_ideas_component',
        methods: ['GET']
    )]
    public function __invoke(
        Request                   $request,
        UserIdeasComponentCreator $responseDataCreator,
        JsonResponseFactory       $jsonResponseFactory,
        string                    $login,
    ): JsonResponse {
        try {
            $jsonResponse = $jsonResponseFactory->create(
                $responseDataCreator(
                    $login,
                    $request->query->getInt('limit'),
                    $request->query->getInt('offset'),
                ),
                Response::HTTP_OK
            );
        } catch (NotFoundException $exception) {
            $jsonResponse = $jsonResponseFactory->create(
                [ResponseKey::ERROR => Message::USER_IDEAS_OR_USER_NOT_FOUND],
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
