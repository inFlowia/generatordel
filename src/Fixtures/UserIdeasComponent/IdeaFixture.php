<?php

declare(strict_types=1);

namespace App\Fixtures\UserIdeasComponent;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IdeaFixture extends Fixture implements DependentFixtureInterface
{
    public const int ID_OF_IDEA_1_OF_REQUESTED_USER = 4;
    public const int ID_OF_IDEA_2_OF_REQUESTED_USER = 5;
    public const int ID_OF_IDEA_3_OF_REQUESTED_USER = 6;
    public const int ID_OF_IDEA_4_OF_REQUESTED_USER = 7;

    public const string CONTENT_OF_IDEA_1_OF_REQUESTED_USER =
        'Прочитать ту самую книгу, что подарили на ДР';
    public const string CONTENT_OF_IDEA_2_OF_REQUESTED_USER =
        'Собрать друзей на настолки';
    public const string CONTENT_OF_IDEA_3_OF_REQUESTED_USER =
        'Вспомнить у кого ближайший день рождения и подобрать подарок';
    public const string CONTENT_OF_IDEA_4_OF_REQUESTED_USER =
        'Починить наушники, которые жалко было выкинуть. Или выкинуть.';

    private const array ID_TO_DATA_MAP = [
        self::ID_OF_IDEA_1_OF_REQUESTED_USER => [
            'content'  => self::CONTENT_OF_IDEA_1_OF_REQUESTED_USER,
            'authorId' => UserFixture::REQUESTED_USER_ID,
        ],
        self::ID_OF_IDEA_2_OF_REQUESTED_USER => [
            'content'  => self::CONTENT_OF_IDEA_2_OF_REQUESTED_USER,
            'authorId' => UserFixture::REQUESTED_USER_ID,
        ],
        self::ID_OF_IDEA_3_OF_REQUESTED_USER => [
            'content'  => self::CONTENT_OF_IDEA_3_OF_REQUESTED_USER,
            'authorId' => UserFixture::REQUESTED_USER_ID,
        ],
        self::ID_OF_IDEA_4_OF_REQUESTED_USER => [
            'content'  => self::CONTENT_OF_IDEA_4_OF_REQUESTED_USER,
            'authorId' => UserFixture::REQUESTED_USER_ID,
        ],
        8 => [
            'content'  => 'Погулять, покормить бездомных котов',
            'authorId' => UserFixture::NOT_REQUESTED_USER_ID,
        ],
    ];

    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        foreach (self::ID_TO_DATA_MAP as $id => $entityData) {
            $entity = (new Idea())
                ->setId($id)
                ->setContent($entityData['content'])
                ->setAuthor(
                    $manager->find(User::class, $entityData['authorId'])
                );

            $manager->persist($entity);
        }
        $manager->flush();
    }

    /** @inheritDoc */
    public function getDependencies(): array
    {
        return [UserFixture::class];
    }
}
