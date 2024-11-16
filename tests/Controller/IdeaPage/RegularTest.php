<?php

declare(strict_types=1);

namespace App\Tests\Controller\IdeaPage;

use App\Fixtures\IdeaPage\IdeaFixture;
use App\Fixtures\IdeaPage\UserFixture;
use App\Tests\Controller\AbstractGetTest;

/** Проверка ЭП: "Страница с данными идеи" */
class RegularTest extends AbstractGetTest
{
    private const int REQUESTED_IDEA_ID = IdeaFixture::REQUESTED_IDEA_ID;
    private const array EXPECTED = [
        'content' => IdeaFixture::REQUESTED_IDEA_CONTENT,
        'author'  => UserFixture::FIRST_USER_LOGIN,
    ];

    /**
     * @throws \JsonException
     */
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
