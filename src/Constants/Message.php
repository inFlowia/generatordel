<?php

declare(strict_types=1);

namespace App\Constants;

/** Константы с сообщениями и прочее полезное при их формировании */
readonly class Message
{
    final public const string IDEA_NOT_FOUND = 'Нет такой идеи... А она точно была?';
    final public const string USER_IDEAS_GETTING_ERROR =
        'При получении идей пользователя возникла непредвиденная ошибка';
    final public const string USER_IDEAS_OR_USER_NOT_FOUND =
        'У этого автора ещё нет идей! А может и автора такого не было...';
}
