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

    public static function getAsArray(): array
    {
        $arr = [];

        foreach (self::cases() as $case) {
            $arr[$case->name] = $case->value;
        }

        return $arr;
    }
}