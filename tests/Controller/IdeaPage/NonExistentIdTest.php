<?php

declare(strict_types=1);

namespace App\Tests\Controller\IdeaPage;

use App\Entity\Idea;
use App\Tests\Controller\AbstractEntityManagerAwareGetTest;
use Symfony\Component\HttpFoundation\Response;

// Проверка ЭП: Страница с данными идеи, при передаче id несуществующей идеи
class NonExistentLoginTest extends AbstractEntityManagerAwareGetTest
{
    public function testAction(): void
    {
        $nonExistentId = self::$em->getRepository(Idea::class)
            ->createQueryBuilder('idea')
            ->select('MAX(idea.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $nonExistentId++;

        self::$client->request(
            'GET',
            self::$router->generate('idea_page', ['id' => $nonExistentId,])
        );

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }
}
