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
    public const REQUESTED_IDEA_ID      = 2;
    public const REQUESTED_IDEA_CONTENT = 'Залезть на дерево.';

    private const ENTITY_DATA = [
        1 => [
            'content'  => 'Узнать, что такое Предел Хейфлика.',
            'authorId' => UserFixture::FIRST_USER_ID,
        ],
        self::REQUESTED_IDEA_ID => [
            'content'  => self::REQUESTED_IDEA_CONTENT,
            'authorId' => UserFixture::FIRST_USER_ID,
        ],
        3 => [
            'content'  => 'Помыть окна.',
            'authorId' => UserFixture::FIRST_USER_ID,
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
