<?php

declare(strict_types=1);

namespace App\Helper;

use App\Constants\FrameworkConstants;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class JsonResponseFactory
{
    public function __construct(private string $environment) {}

    public function create(
        mixed $data = null,
        int   $status = Response::HTTP_OK,
        array $headers = [],
        bool  $json = false,
    ): JsonResponse {
        $response = new JsonResponse($data, $status, $headers, $json);

        if ($this->environment === FrameworkConstants::TEST_ENVIRONMENT_NAME) {
            // В тестах при ошибке ответ, содержащий юникод (например текст на
            // русском) в консоли будет сразу читабелен. Без этого будет
            // выглядеть так: {"error":"\u0442\u0435\u043A\u0441\u0442"}
            $response->setEncodingOptions(\JSON_UNESCAPED_UNICODE);
        }

        return $response;
    }
}