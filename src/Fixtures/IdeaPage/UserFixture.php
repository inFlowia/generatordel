<?php

declare(strict_types=1);

namespace App\Fixtures\IdeaPage;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public const FIRST_USER_ID    = 1;
    public const FIRST_USER_LOGIN = 'Sandy Suok';

    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        $user = (new User())
            ->setId(self::FIRST_USER_ID)
            ->setLogin(self::FIRST_USER_LOGIN)
            ->setPasswordHashByPassword('~#^pWd4LastDay');

        $manager->persist($user);

        $manager->flush();
    }
}
