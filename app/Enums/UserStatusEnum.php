<?php

namespace App\Enums;

enum UserStatusEnum: int
{
    case PENDING = 2;
    case ACTIVE = 1;
    case INACTIVE = 0;
}
