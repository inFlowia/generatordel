<?php

declare(strict_types=1);

namespace App\Tests\E2ETest\UserIdeasComponent;

use App\Constants\Message;
use App\Constants\ResponseKey;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\E2ETest\AbstractEntityManagerAwareGetTest;
use Doctrine\ORM\Exception\NotSupported;
use Symfony\Component\HttpFoundation\Response;

/**
 * Проверка ЭП: "Компонент с идеями пользователя", если нет пользователя
 * с таким логином нет
 */
class NonExistentLoginTest extends AbstractEntityManagerAwareGetTest
{
    private const int LIMIT  = 2;
    private const int OFFSET = 1;

    /**
     * @throws NotSupported
     * @throws \JsonException
     */
    public function testAction(): void
    {
        /** @var $userRepository UserRepository */
        $userRepository = self::$em->getRepository(User::class);

        $nonExistentLogin = 0;
        while (
            $userRepository->findOneBy(['login' => (string) $nonExistentLogin]) !== null
        ) {
            $nonExistentLogin++;
        }

        self::$client->request(
            'GET',
            self::$router->generate(
                'user_ideas_component',
                [
                    'login'  => $nonExistentLogin,
                    'limit'  => self::LIMIT,
                    'offset' => self::OFFSET,
                ]
            )
        );

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);

        $this->assertResponseBodyEquals(
            [ResponseKey::ERROR => Message::USER_IDEAS_OR_USER_NOT_FOUND,]
        );
    }
}
