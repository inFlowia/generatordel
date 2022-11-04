<?php

declare(strict_types=1);

namespace App\Responder;

use App\Entity\Idea;
use App\Repository\IdeaRepository;

/** ЭП: Страница с данными идеи */
class IdeaPageResponder
{
    private IdeaRepository $repository;

    /**
     * @param IdeaRepository $repository
     */
    public function __construct(IdeaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     *
     * @return array
     */
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
