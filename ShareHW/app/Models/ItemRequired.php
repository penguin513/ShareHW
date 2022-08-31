<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequired extends Model
{
    use HasFactory;

    public const ITEM_REQUIRED_1 = 1;
    public const ITEM_REQUIRED_2 = 2;

    public const ITEM_REQUIRED_NAME_1 = '必要なし';
    public const ITEM_REQUIRED_NAME_2 = '必要！';

    public const ITEM_REQUIRED_OBJECT = [
        self::ITEM_REQUIRED_1 => self::ITEM_REQUIRED_NAME_1,
        self::ITEM_REQUIRED_2 => self::ITEM_REQUIRED_NAME_2,
    ];

    public const ITEM_REQUIRED_ARRAY = [
        self::ITEM_REQUIRED_1,
        self::ITEM_REQUIRED_2,
    ];
}
