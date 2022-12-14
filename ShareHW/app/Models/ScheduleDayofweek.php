<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDayofweek extends Model
{
    use HasFactory;

    public const SCHEDULE_DAYOFWEEK_MONDAY = 1;
    public const SCHEDULE_DAYOFWEEK_TUESDAY = 2;
    public const SCHEDULE_DAYOFWEEK_WEDNESDAY = 3;
    public const SCHEDULE_DAYOFWEEK_THURSDAY = 4;
    public const SCHEDULE_DAYOFWEEK_FRYDAY = 5;
    public const SCHEDULE_DAYOFWEEK_SATURDAY = 6;
    public const SCHEDULE_DAYOFWEEK_SUNDAY = 7;
    public const SCHEDULE_DAYOFWEEK_EVERYDAY = 8;
    public const SCHEDULE_DAYOFWEEK_WEEKDAY = 9;
    public const SCHEDULE_DAYOFWEEK_HOLIDAY = 10;

    public const SCHEDULE_DAYOFWEEK_NAME_MONDAY = '月曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_TUESDAY = '火曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_WEDNESDAY = '水曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_THURSDAY = '木曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_FRYDAY = '金曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_SATURDAY = '土曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_SUNDAY = '日曜日';
    public const SCHEDULE_DAYOFWEEK_NAME_EVERYDAY = '毎日';
    public const SCHEDULE_DAYOFWEEK_NAME_WEEKDAY = '平日（月～金）';
    public const SCHEDULE_DAYOFWEEK_NAME_HOLIDAY = '休日（土、日）';

    public const SCHEDULE_DAYOFWEEK_OBJECT = [
        self::SCHEDULE_DAYOFWEEK_MONDAY => self::SCHEDULE_DAYOFWEEK_NAME_MONDAY,
        self::SCHEDULE_DAYOFWEEK_TUESDAY => self::SCHEDULE_DAYOFWEEK_NAME_TUESDAY,
        self::SCHEDULE_DAYOFWEEK_WEDNESDAY => self::SCHEDULE_DAYOFWEEK_NAME_WEDNESDAY,
        self::SCHEDULE_DAYOFWEEK_THURSDAY => self::SCHEDULE_DAYOFWEEK_NAME_THURSDAY,
        self::SCHEDULE_DAYOFWEEK_FRYDAY => self::SCHEDULE_DAYOFWEEK_NAME_FRYDAY,
        self::SCHEDULE_DAYOFWEEK_SATURDAY => self::SCHEDULE_DAYOFWEEK_NAME_SATURDAY,
        self::SCHEDULE_DAYOFWEEK_SUNDAY => self::SCHEDULE_DAYOFWEEK_NAME_SUNDAY,
        self::SCHEDULE_DAYOFWEEK_EVERYDAY => self::SCHEDULE_DAYOFWEEK_NAME_EVERYDAY,
        self::SCHEDULE_DAYOFWEEK_WEEKDAY => self::SCHEDULE_DAYOFWEEK_NAME_WEEKDAY,
        self::SCHEDULE_DAYOFWEEK_HOLIDAY => self::SCHEDULE_DAYOFWEEK_NAME_HOLIDAY,
    ];

    public const SCHEDULE_DAYOFWEEK_ARRAY = [
        self::SCHEDULE_DAYOFWEEK_MONDAY,
        self::SCHEDULE_DAYOFWEEK_TUESDAY,
        self::SCHEDULE_DAYOFWEEK_WEDNESDAY,
        self::SCHEDULE_DAYOFWEEK_THURSDAY,
        self::SCHEDULE_DAYOFWEEK_FRYDAY,
        self::SCHEDULE_DAYOFWEEK_SATURDAY,
        self::SCHEDULE_DAYOFWEEK_SUNDAY,
        self::SCHEDULE_DAYOFWEEK_EVERYDAY,
        self::SCHEDULE_DAYOFWEEK_WEEKDAY,
        self::SCHEDULE_DAYOFWEEK_HOLIDAY,
    ];
}
