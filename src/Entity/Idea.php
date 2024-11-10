<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Идея - чем заняться
 */
#[ORM\Entity(repositoryClass: IdeaRepository::class)]
class Idea
{
    /**
     * Обнуляемо, для возможности ORM удалять экземпляры.
     * Задано значение по умолчанию для избежания ошибки доступа до
     * инициализации при методах типа add.
     * Значение по умолчанию null а не 0 во избежание ошибки при добавлении
     * через SonataAdmin.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    #[ORM\Column(type: 'text', nullable: false)]
    private string $content;

    #[ORM\JoinColumn(nullable: false)]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'ideas')]
    private User $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Idea
    {
        $this->id = $id;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): Idea
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): Idea
    {
        $this->author = $author;

        return $this;
    }
}
