<?php

namespace App\Security;

enum UserRoleType: string
{
    case SuperAdmin = 'ROLE_SUPER_ADMIN';
    case Admin = 'ROLE_ADMIN';
    case User = 'ROLE_USER';
}