<?php

declare(strict_types=1);

namespace App\Fixtures\UserIdeas;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IdeaFixture extends Fixture implements DependentFixtureInterface
{
    public const ID_OF_IDEA_1_OF_REQUESTED_USER = 4;
    public const ID_OF_IDEA_2_OF_REQUESTED_USER = 5;
    public const ID_OF_IDEA_3_OF_REQUESTED_USER = 6;
    public const ID_OF_IDEA_4_OF_REQUESTED_USER = 7;

    public const CONTENT_OF_IDEA_1_OF_REQUESTED_USER =
        'Прочитать тот самый томик, который подарили много лет назад.';
    public const CONTENT_OF_IDEA_2_OF_REQUESTED_USER =
        'Позвать друзей на чай со вкусняшками.';
    public const CONTENT_OF_IDEA_3_OF_REQUESTED_USER =
        'Слоняться по книжному пока не выгонят.';
    public const CONTENT_OF_IDEA_4_OF_REQUESTED_USER =
        'Починить наушники, которые жалко было выкинуть. Или выкинуть.';

    private const ENTITY_DATA = [
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
            'content'  => self::CONTENT_OF_IDEA_3_OF_REQUESTED_USER,
            'authorId' => UserFixture::REQUESTED_USER_ID,
        ],
        8 => [
            'content'  => 'Походить по улицам, покормить котов',
            'authorId' => UserFixture::NOT_REQUESTED_USER_ID,
        ],
    ];

    /** @inheritDoc */
    public function load(ObjectManager $manager): void
    {
        foreach (self::ENTITY_DATA as $id => $entityData) {
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
