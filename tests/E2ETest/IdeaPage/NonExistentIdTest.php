<?php

declare(strict_types=1);

namespace App\Tests\E2ETest\IdeaPage;

use App\Constants\Message;
use App\Constants\ResponseKey;
use App\Entity\Idea;
use App\Tests\E2ETest\AbstractEntityManagerAwareGetTest;
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
     * @throws \JsonException
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

        $responseContent = self::$client->getResponse()->getContent();
        $this->assertNotFalse($responseContent);

        $decodedContent = \json_decode(
            $responseContent,
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $this->assertEquals(
            [ResponseKey::ERROR => Message::IDEA_NOT_FOUND],
            $decodedContent
        );
    }
}
