<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Идея - чем заняться
 *
 * @ORM\Entity(repositoryClass="App\Repository\IdeaRepository")
 */
class Idea
{
    use IdTrait;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private string $content;

    /**
     * @var User $author
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private User $author;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return Idea
     */
    public function setContent(string $content): Idea
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     *
     * @return Idea
     */
    public function setAuthor(User $author): Idea
    {
        $this->author = $author;

        return $this;
    }
}
