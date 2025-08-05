<?php

namespace App\Enums\Permissions;

enum RoleEnum: int
{
    case super = 1;
    case debugger = 2;

    public static function getList(): array
    {
        return array_column(
            array_filter(self::cases(), fn($role) => $role !== self::debugger),
            'value',
            'name'
        );
    }
}
