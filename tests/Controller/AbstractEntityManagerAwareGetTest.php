<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Doctrine\ORM\EntityManager;

// Для тестов GET-запросов к ЭП, в которых нужен EntityManager
abstract class AbstractEntityManagerAwareGetTest extends AbstractGetTest
{
    protected static EntityManager $em;

    /** @inheritDoc */
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        self::$em = self::$container->get('doctrine')->getManager('default');
    }
}
