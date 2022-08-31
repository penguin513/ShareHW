<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    public const ITEM_CATEGORY_1 = 1;
    public const ITEM_CATEGORY_2 = 2;
    public const ITEM_CATEGORY_3 = 3;
    public const ITEM_CATEGORY_4 = 4;
    public const ITEM_CATEGORY_5 = 5;
    public const ITEM_CATEGORY_6 = 6;
    public const ITEM_CATEGORY_7 = 7;
    public const ITEM_CATEGORY_8 = 8;

    public const ITEM_CATEGORY_NAME_1 = '未分類';
    public const ITEM_CATEGORY_NAME_2 = '飲み物';
    public const ITEM_CATEGORY_NAME_3 = 'お菓子';
    public const ITEM_CATEGORY_NAME_4 = '調味料';
    public const ITEM_CATEGORY_NAME_5 = 'その他食品';
    public const ITEM_CATEGORY_NAME_6 = '日用品';
    public const ITEM_CATEGORY_NAME_7 = '家電関係';
    public const ITEM_CATEGORY_NAME_8 = 'その他';

    public const ITEM_CATEGORY_OBJECT = [
        self::ITEM_CATEGORY_1 => self::ITEM_CATEGORY_NAME_1,
        self::ITEM_CATEGORY_2 => self::ITEM_CATEGORY_NAME_2,
        self::ITEM_CATEGORY_3 => self::ITEM_CATEGORY_NAME_3,
        self::ITEM_CATEGORY_4 => self::ITEM_CATEGORY_NAME_4,
        self::ITEM_CATEGORY_5 => self::ITEM_CATEGORY_NAME_5,
        self::ITEM_CATEGORY_6 => self::ITEM_CATEGORY_NAME_6,
        self::ITEM_CATEGORY_7 => self::ITEM_CATEGORY_NAME_7,
        self::ITEM_CATEGORY_8 => self::ITEM_CATEGORY_NAME_8,
    ];

    public const ITEM_CATEGORY_ARRAY = [
        self::ITEM_CATEGORY_1,
        self::ITEM_CATEGORY_2,
        self::ITEM_CATEGORY_3,
        self::ITEM_CATEGORY_4,
        self::ITEM_CATEGORY_5,
        self::ITEM_CATEGORY_6,
        self::ITEM_CATEGORY_7,
        self::ITEM_CATEGORY_8,
    ];
}
