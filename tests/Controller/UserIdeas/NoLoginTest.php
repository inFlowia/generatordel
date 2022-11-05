<?php

declare(strict_types=1);

namespace App\Tests\Controller\UserIdeas;

use App\Tests\Controller\AbstractGetTest;
use Symfony\Component\HttpFoundation\Response;

/** Проверка ЭП: Страница с данными идеи, если логин не передан */
class NoLoginTest extends AbstractGetTest
{
    private const LIMIT  = 2;
    private const OFFSET = 1;

    public function testAction(): void
    {
        self::$client->request(
            'GET',
            self::$router->generate(
                'user_ideas',
                [
                    'limit'  => self::LIMIT,
                    'offset' => self::OFFSET,
                ]
            )
        );

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }
}
