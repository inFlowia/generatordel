<?php

declare(strict_types=1);

namespace App\Tests\Controller\UserIdeas;

use App\Fixtures\UserIdeas\IdeaFixture;
use App\Fixtures\UserIdeas\UserFixture;
use App\Tests\Controller\AbstractGetTest;

/** Проверка обработки limit и offset в ЭП: "Компонент с идеями пользователя" */
class LimitOffsetTest extends AbstractGetTest
{
    private const string REQUESTED_USER_LOGIN = UserFixture::REQUESTED_USER_LOGIN;
    private const int LIMIT = 2;
    private const int OFFSET = 1;

    private const array EXPECTED = [
        0 => [
            'id'      => IdeaFixture::ID_OF_IDEA_3_OF_REQUESTED_USER,
            'content' => IdeaFixture::CONTENT_OF_IDEA_3_OF_REQUESTED_USER,
        ],
        1 => [
            'id'      => IdeaFixture::ID_OF_IDEA_2_OF_REQUESTED_USER,
            'content' => IdeaFixture::CONTENT_OF_IDEA_2_OF_REQUESTED_USER,
        ]
    ];

    public function testAction(): void
    {
        self::$client->request(
            'GET',
            self::$router->generate(
                'user_ideas',
                [
                    'login'  => self::REQUESTED_USER_LOGIN,
                    'limit'  => self::LIMIT,
                    'offset' => self::OFFSET,
                ]
            )
        );

        self::assertResponseIsSuccessful();
        self::assertEquals(
            self::EXPECTED,
            \json_decode(
                self::$client->getResponse()->getContent(),
                true,
                512,
                JSON_THROW_ON_ERROR
            )
        );
    }
}
