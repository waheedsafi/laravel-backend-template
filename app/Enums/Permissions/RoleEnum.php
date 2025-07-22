<?php

namespace App\Enums\Permissions;

enum RoleEnum: int
{
    case super = 1;
    case admin = 2;
    case user = 3;
    case debugger = 4;

    public static function getList(): array
    {
        return array_column(
            array_filter(self::cases(), fn($role) => $role !== self::debugger),
            'value',
            'name'
        );
    }
}
