<?php

declare(strict_types=1);

namespace App\Tests\E2ETest\UserIdeasComponent;

use App\Tests\E2ETest\AbstractGetTest;
use Symfony\Component\HttpFoundation\Response;

/** Проверка ЭП: "Компонент с идеями пользователя", если логин не передан */
class NoLoginTest extends AbstractGetTest
{
    private const int LIMIT = 2;
    private const int OFFSET = 1;

    public function testAction(): void
    {
        self::$client->request(
            'GET',
            self::$router->generate(
                'user_ideas_component',
                [
                    'limit'  => self::LIMIT,
                    'offset' => self::OFFSET,
                ]
            )
        );

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }
}
