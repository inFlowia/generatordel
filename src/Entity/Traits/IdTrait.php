<?php

declare(strict_types=1);

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait IdTrait
{
    /**
     * @var int|null $id Обнуляемо, для возможности ORM удалять экземпляры.
     *                   Задано значение по умолчанию для избежания ошибки
     *                   доступа до инициализации при методах типа add.
     *                   Значение по умолчанию null а не 0 во избежание ошибки
     *                   при добавлении через SonataAdmin.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected ?int $id = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
}
