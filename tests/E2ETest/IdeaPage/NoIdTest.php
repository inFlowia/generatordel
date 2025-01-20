<?php

declare(strict_types=1);

namespace App\Tests\E2ETest\IdeaPage;

use App\Tests\E2ETest\AbstractGetTest;
use Symfony\Component\HttpFoundation\Response;

/** Проверка ЭП: "Страница с данными идеи", при непереданном id */
class NoIdTest extends AbstractGetTest
{
    public function testAction(): void
    {
        self::$client->request('GET', self::$router->generate('idea_page'));

        self::assertResponseStatusCodeSame(Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
