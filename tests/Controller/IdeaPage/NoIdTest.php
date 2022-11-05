<?php

declare(strict_types=1);

namespace App\Tests\Controller\IdeaPage;

use App\Tests\Controller\AbstractGetTest;
use Symfony\Component\HttpFoundation\Response;

/** Проверка ЭП: Страница с данными идеи, при непереданном id*/
class NoIdTest extends AbstractGetTest
{
    public function testAction(): void
    {
        self::$client->request('GET', self::$router->generate('idea_page'));

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }
}
