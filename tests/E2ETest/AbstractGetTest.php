<?php

declare(strict_types=1);

namespace App\Tests\E2ETest;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/** Для тестов GET-запросов к ЭП */
abstract class AbstractGetTest extends WebTestCase
{
    protected static KernelBrowser $client;
    protected static ContainerInterface $container;
    protected static UrlGeneratorInterface $router;

    /** @inheritDoc */
    public static function setUpBeforeClass(): void
    {
        self::$client = static::createClient();
        static::bootKernel(['environment' => 'test']);
        self::$container = static::$kernel->getContainer();
        self::$router = self::$container->get('router');
    }
}
