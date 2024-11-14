<?php

declare(strict_types=1);

namespace App\ResponseDataCreator;

use App\Entity\Idea;
use App\Repository\IdeaRepository;

/** ЭП: Страница с данными идеи */
readonly class IdeaPageCreator
{
    public function __construct(private IdeaRepository $repository) {}

    public function __invoke(int $id): array
    {
        /** @var Idea $idea */
        $idea = $this->repository->find($id);

        return [
            'content' => $idea->getContent(),
            'author'  => $idea->getAuthor()->getLogin(),
        ];
    }
}
