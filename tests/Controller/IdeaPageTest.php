<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Fixtures\IdeaPageTest\IdeaFixture;
use App\Fixtures\IdeaPageTest\UserFixture;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/** Проверка ЭП: Страница с данными идеи */
class IdeaPageTest extends WebTestCase
{
    private const REQUESTED_IDEA_ID = IdeaFixture::REQUESTED_IDEA_ID;
    private const EXPECTED = [
        'content' => IdeaFixture::REQUESTED_IDEA_CONTENT,
        'author'  => UserFixture::FIRST_USER_LOGIN,
    ];

    private ?KernelBrowser $client;
    private ContainerInterface $container;
    private UrlGeneratorInterface $router;

    public function testAction(): void
    {
        /* todo: вынести инициализацию вспомогательных свойств в абстрактный
        класс */
        $this->client = static::createClient();
        static::bootKernel(['environment' => 'test']);
        $this->container = static::$kernel->getContainer();
        $this->router = $this->container->get('router');
        //

        $this->client->request(
            'GET',
            $this->router->generate(
                'idea_page',
                ['id' => self::REQUESTED_IDEA_ID]
            )
        );

        self::assertResponseIsSuccessful();
        self::assertEquals(
            self::EXPECTED,
            \json_decode(
                $this->client->getResponse()->getContent(),
                true,
                512,
                JSON_THROW_ON_ERROR
            )
        );
    }
}
