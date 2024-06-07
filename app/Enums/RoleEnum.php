<?php

namespace App\Enums;

enum RoleEnum: string
{
    case Admin = 'admin';
    case Moderator = 'moderator';
    case Reader = 'reader';
}
