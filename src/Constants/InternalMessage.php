<?php

declare(strict_types=1);

namespace App\Constants;

/** Внутренние сообщения исключительно для сервисных целей
 *
 * Не для клиента
 */
readonly class InternalMessage
{
    final public const string IDEA_NOT_FOUND = 'Идея с ID "%d" не найдена';
    final public const string USER_IDEAS_OR_USER_NOT_FOUND =
        'Пользователя с логином "%1$s" не существует, либо у него не найдено '.
        'идей при limit: %2$d и offset: %3$d';
}