<?php

declare(strict_types=1);

namespace App\Fixtures\IdeaPage;

use App\Entity\Idea;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class IdeaFixture extends Fixture implements DependentFixtureInterface
{
    public const int REQUESTED_IDEA_ID = 2;
    public const string REQUESTED_IDEA_CONTENT = 'Сходить в лес';

    private const array ID_TO_DATA_MAP = [
        1 => [
            'content' => 'Послушать музыку',
            'authorId' => UserFixture::FIRST_USER_ID,
        ],
        self::REQUESTED_IDEA_ID => [
            'content' => self::REQUESTED_IDEA_CONTENT,
            'authorId' => UserFixture::FIRST_USER_ID,
        ],
        3 => [
            'content' => 'Помыть окна',
            'authorId' => UserFixture::FIRST_USER_ID,
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
