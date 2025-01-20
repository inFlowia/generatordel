<?php

declare(strict_types=1);

namespace App\Constants;

/** Внутренние сообщения исключительно для сервисных целей
 *
 * Не для клиента
 */
readonly class InternalMessage
{
    final public const string IDEA_NOT_FOUND = 'Идея с ID "%s" не найдена';
}