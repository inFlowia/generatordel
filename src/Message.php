<?php

declare(strict_types=1);

namespace App;

/** Константы с сообщениями и прочее полезное при их формировании */
class Message
{
    public const IDEA_NOT_FOUND = 'Нет такой идеи... А она точно была?';
    public const USER_IDEAS_GETTING_ERROR =
        'При получении идей пользователя возникла непредвиденная ошибка';
    public const USER_IDEAS_OR_USER_NOT_FOUND =
        'У этого автора ещё нет идей! А может и автора такого не было...';
}
