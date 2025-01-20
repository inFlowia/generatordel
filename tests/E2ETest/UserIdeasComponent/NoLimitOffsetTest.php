<?php

declare(strict_types=1);

namespace App\Tests\E2ETest\UserIdeasComponent;

use App\Fixtures\UserIdeasComponent\IdeaFixture;
use App\Fixtures\UserIdeasComponent\UserFixture;
use App\Tests\E2ETest\AbstractGetTest;

/**
 * Проверка ЭП: "Компонент с идеями пользователя", с непереданными limit и
 * offset
 */
class NoLimitOffsetTest extends AbstractGetTest
{
    private const string REQUESTED_USER_LOGIN = UserFixture::REQUESTED_USER_LOGIN;

    private const array EXPECTED = [
        0 => [
            'id'      => IdeaFixture::ID_OF_IDEA_4_OF_REQUESTED_USER,
            'content' => IdeaFixture::CONTENT_OF_IDEA_4_OF_REQUESTED_USER,
        ],
        1 => [
            'id'      => IdeaFixture::ID_OF_IDEA_3_OF_REQUESTED_USER,
            'content' => IdeaFixture::CONTENT_OF_IDEA_3_OF_REQUESTED_USER,
        ],
        2 => [
            'id'      => IdeaFixture::ID_OF_IDEA_2_OF_REQUESTED_USER,
            'content' => IdeaFixture::CONTENT_OF_IDEA_2_OF_REQUESTED_USER,
        ],
        3 => [
            'id'      => IdeaFixture::ID_OF_IDEA_1_OF_REQUESTED_USER,
            'content' => IdeaFixture::CONTENT_OF_IDEA_1_OF_REQUESTED_USER,
        ]
    ];

    /**
     * @throws \JsonException
     */
    public function testAction(): void
    {
        self::$client->request(
            'GET',
            self::$router->generate(
                'user_ideas_component',
                [
                    'login' => self::REQUESTED_USER_LOGIN,
                ]
            )
        );

        self::assertResponseIsSuccessful();
        $this->assertResponseBodyEquals(self::EXPECTED);
    }
}
