<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;


    public const USER_ROLE_ADMIN = 1;
    public const USER_ROLE_GENERAL = 5;

    public const USER_ROLE_NAME_ADMIN = '管理者';
    public const USER_ROLE_NAME_GENERAL = '一般';

    public const USER_ROLE_OBJECT = [
        self::USER_ROLE_ADMIN => self::USER_ROLE_NAME_ADMIN,
        self::USER_ROLE_GENERAL => self::USER_ROLE_NAME_GENERAL,
    ];

    public const USER_ROLE_ARRAY = [
        self::USER_ROLE_ADMIN,
        self::USER_ROLE_GENERAL,
    ];
}
