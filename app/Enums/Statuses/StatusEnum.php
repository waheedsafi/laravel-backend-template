<?php

namespace App\Enums\Statuses;

enum StatusEnum: int
{
    // General
    case active = 1;
    case block = 2;
    case pending = 3;
    case rejected = 4;
}
