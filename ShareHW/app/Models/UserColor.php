<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserColor extends Model
{
    use HasFactory;


    public const USER_COLOR_DEFAULT = 1;
    public const USER_COLOR_RED = 2;
    public const USER_COLOR_PINK = 3;
    public const USER_COLOR_YELLOW = 4;
    public const USER_COLOR_BLUE = 5;
    public const USER_COLOR_SKY = 6;
    public const USER_COLOR_TEAL = 7;
    public const USER_COLOR_PURPLE = 8;
    public const USER_COLOR_GREEN = 9;

    public const USER_COLOR_NAME_DEFAULT = 'orange';
    public const USER_COLOR_NAME_RED = 'red';
    public const USER_COLOR_NAME_PINK = 'pink';
    public const USER_COLOR_NAME_YELLOW = 'yellow';
    public const USER_COLOR_NAME_BLUE = 'blue';
    public const USER_COLOR_NAME_SKY = 'sky';
    public const USER_COLOR_NAME_TEAL = 'teal';
    public const USER_COLOR_NAME_PURPLE = 'purple';
    public const USER_COLOR_NAME_GREEN = 'green';

    public const USER_COLOR_OBJECT = [
        self::USER_COLOR_DEFAULT => self::USER_COLOR_NAME_DEFAULT,
        self::USER_COLOR_RED => self::USER_COLOR_NAME_RED,
        self::USER_COLOR_PINK => self::USER_COLOR_NAME_PINK,
        self::USER_COLOR_YELLOW => self::USER_COLOR_NAME_YELLOW,
        self::USER_COLOR_BLUE => self::USER_COLOR_NAME_BLUE,
        self::USER_COLOR_SKY => self::USER_COLOR_NAME_SKY,
        self::USER_COLOR_TEAL => self::USER_COLOR_NAME_TEAL,
        self::USER_COLOR_PURPLE => self::USER_COLOR_NAME_PURPLE,
        self::USER_COLOR_GREEN => self::USER_COLOR_NAME_GREEN,
    ];

    public const USER_COLOR_ARRAY = [
        self::USER_COLOR_DEFAULT,
        self::USER_COLOR_RED,
        self::USER_COLOR_PINK,
        self::USER_COLOR_YELLOW,
        self::USER_COLOR_BLUE,
        self::USER_COLOR_SKY,
        self::USER_COLOR_TEAL,
        self::USER_COLOR_PURPLE,
        self::USER_COLOR_GREEN,
    ];
}
