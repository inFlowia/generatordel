<?php

declare(strict_types=1);

namespace App\Fixtures\UserIdeas;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const int REQUESTED_USER_ID     = 2;
    public const int NOT_REQUESTED_USER_ID = 3;

    public const string REQUESTED_USER_LOGIN = 'Konata';

    private const array ID_TO_DATA_MAP = [
        self::REQUESTED_USER_ID => [
            'login'    => self::REQUESTED_USER_LOGIN,
            'password' => '473581134q>{X',
        ],
        3 => [
            'login'    => 'Пётр',
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
        foreach (self::ID_TO_DATA_MAP as $id => $entityData) {
            $entity = (new User())
                ->setId($id)
                ->setLogin($entityData['login'])
                ->setPasswordHashByPassword($entityData['password']);

            $manager->persist($entity);
        }
        $manager->flush();
    }
}
