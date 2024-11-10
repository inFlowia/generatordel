<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
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

    #[ORM\Column(type: 'string', length: 25, unique: true, nullable: false)]
    private string $login;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $passwordHash;

    /**
     * @var Collection<Idea> $ideas
     */
    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Idea::class)]
    private Collection $ideas;

    public function __construct()
    {
        $this->ideas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): User
    {
        $this->id = $id;

        return $this;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): User
    {
        $this->login = $login;

        return $this;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): User
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    public function setPasswordHashByPassword(string $password): User
    {
        $this->passwordHash = \password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }

    public function getIdeas(): Collection
    {
        return $this->ideas;
    }

    public function setIdeas(Collection $ideas): User
    {
        $this->ideas = $ideas;

        return $this;
    }
}
