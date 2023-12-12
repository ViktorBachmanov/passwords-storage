<?php

namespace App\Enums;


enum Item: string
{
    case Group = 'groups';
    case Password = 'passwords';

    public static function getMorphMap(): array
    {
        return [
            self::Group->value => 'App\Models\Group',
            self::Password->value => 'App\Models\Password',
        ];
    }
}