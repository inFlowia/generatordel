<?php

declare(strict_types=1);

namespace App\ResponseDataCreator;

use App\Exception\UserIdeasException;
use App\Message;
use App\Repository\IdeaRepository;

/** ЭП: компонент с идеями пользователя */
readonly class UserIdeasCreator
{
    private const int DEFAULT_LIMIT = 8;

    public function __construct(private IdeaRepository $repository) {}

    /**
     * @throws UserIdeasException
     */
    public function __invoke(
        string $login,
        int    $limit,
        ?int   $offset = 0
    ): array {
        if ($limit === 0) {
            $limit = self::DEFAULT_LIMIT;
        }

        $ideas = $this->repository->findByUserLogin($login, $limit, $offset);

        if (\count($ideas) < 1) {
            throw new UserIdeasException(Message::USER_IDEAS_OR_USER_NOT_FOUND);
        }

        return $ideas;
    }
}
