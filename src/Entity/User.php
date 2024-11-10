<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\IdTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\UserRepository::class)]
class User
{
    use IdTrait;

    #[ORM\Column(type: 'string', length: 25, nullable: false, unique: true)]
    private string $login;

    #[ORM\Column(type: 'string', nullable: false)]
    private string $passwordHash;

    /**
     * @var Collection<Idea> $ideas
     */
    #[ORM\OneToMany(targetEntity: \App\Entity\Idea::class, mappedBy: 'author')]
    private Collection $ideas;

    public function __construct()
    {
        $this->ideas = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     *
     * @return User
     */
    public function setLogin(string $login): User
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @param string $passwordHash
     *
     * @return User
     */
    public function setPasswordHash(string $passwordHash): User
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPasswordHashByPassword(string $password): User
    {
        $this->passwordHash = \password_hash($password, PASSWORD_DEFAULT);

        return $this;
    }
}
