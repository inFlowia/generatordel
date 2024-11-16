<?php

declare(strict_types=1);

namespace App\Tests\Controller\IdeaPage;

use App\Entity\Idea;
use App\Tests\Controller\AbstractEntityManagerAwareGetTest;
use Doctrine\ORM\Exception\NotSupported;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\HttpFoundation\Response;

/** Проверка ЭП: "Страница с данными идеи" при передаче id несуществующей идеи */
class NonExistentIdTest extends AbstractEntityManagerAwareGetTest
{
    /**
     * @throws NonUniqueResultException
     * @throws NotSupported
     * @throws NoResultException
     */
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
