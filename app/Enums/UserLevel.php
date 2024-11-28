<?php

namespace App\Enums;

enum UserLevel: int
{
    case Standard = 0;
    case Moderator = 1;
    case Administrator = 2;
}
