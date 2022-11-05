<?php

declare(strict_types=1);

namespace App\Tests\Controller\UserIdeas;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Tests\Controller\AbstractEntityManagerAwareGetTest;
use Symfony\Component\HttpFoundation\Response;

/** Проверка ЭП: Страница с данными идеи, если пользователя с переданным логином
 * нет */
class NonExistentLoginTest extends AbstractEntityManagerAwareGetTest
{
    private const LIMIT  = 2;
    private const OFFSET = 1;

    public function testAction(): void
    {
        /** @var UserRepository */
        $userRepository = self::$em->getRepository(User::class);

        $nonExistentLogin = 0;
        while (
            !empty($userRepository->findOneBy(['login' => (string) $nonExistentLogin]))
        ) {
            $nonExistentLogin++;
        };

        self::$client->request(
            'GET',
            self::$router->generate(
                'user_ideas',
                [
                    'login'  => $nonExistentLogin,
                    'limit'  => self::LIMIT,
                    'offset' => self::OFFSET,
                ]
            )
        );

        self::assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
    }
}
