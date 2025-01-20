<?php

declare(strict_types=1);

namespace App\ResponseDataCreator;

use App\Constants\InternalMessage;
use App\Exception\NotFoundException;
use App\Repository\IdeaRepository;

/** ЭП: компонент с идеями пользователя */
readonly class UserIdeasComponentCreator
{
    private const int DEFAULT_LIMIT = 8;

    public function __construct(private IdeaRepository $repository) {}

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
            throw new NotFoundException(
                \sprintf(
                    InternalMessage::USER_IDEAS_OR_USER_NOT_FOUND,
                    $login,
                    $limit,
                    $offset
                )
            );
        }

        return $ideas;
    }
}
