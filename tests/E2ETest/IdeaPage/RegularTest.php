<?php

declare(strict_types=1);

namespace App\Tests\E2ETest\IdeaPage;

use App\Fixtures\IdeaPage\IdeaFixture;
use App\Fixtures\IdeaPage\UserFixture;
use App\Tests\E2ETest\AbstractGetTest;

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
        $this->assertResponseBodyEquals(self::EXPECTED);
    }
}
