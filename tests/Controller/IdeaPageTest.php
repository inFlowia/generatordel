<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Fixtures\IdeaPageTest\IdeaFixture;
use App\Fixtures\IdeaPageTest\UserFixture;

/** Проверка ЭП: Страница с данными идеи */
class IdeaPageTest extends AbstractGetTest
{
    private const REQUESTED_IDEA_ID = IdeaFixture::REQUESTED_IDEA_ID;
    private const EXPECTED = [
        'content' => IdeaFixture::REQUESTED_IDEA_CONTENT,
        'author'  => UserFixture::FIRST_USER_LOGIN,
    ];

    public function testAction(): void
    {
        self::$client->request(
            'GET',
            self::$router->generate(
                'idea_page',
                ['id' => self::REQUESTED_IDEA_ID]
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
