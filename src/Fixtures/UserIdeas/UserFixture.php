<?php

declare(strict_types=1);

namespace App\Fixtures\UserIdeas;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const REQUESTED_USER_ID     = 2;
    public const NOT_REQUESTED_USER_ID = 3;

    public const REQUESTED_USER_LOGIN = 'Konata';

    private const ENTITY_DATA = [
        self::REQUESTED_USER_ID => [
            'login'    => self::REQUESTED_USER_LOGIN,
            'password' => '473581134q>{X',
        ],
        3 => [
            'login'    => 'Квадратик',
            'password' => '[_]/#f4%d',
        ],
        4 => [
            'login'    => '0',
            'password' => '0000',
        ],
        5 => [
            'login'    => '1',
            'password' => '123',
        ],
    ];

    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        foreach (self::ENTITY_DATA as $id => $entityData) {
            $entity = (new User())
                ->setId($id)
                ->setLogin($entityData['login'])
                ->setPasswordHashByPassword($entityData['password']);

            $manager->persist($entity);
        }
        $manager->flush();
    }
}
