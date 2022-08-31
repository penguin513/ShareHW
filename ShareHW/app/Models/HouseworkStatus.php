<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseworkStatus extends Model
{
    use HasFactory;


    public const HOMEWORK_STATUS_UNDONE = 1;
    public const HOMEWORK_STATUS_DOING = 2;
    public const HOMEWORK_STATUS_DONE = 3;

    public const HOMEWORK_STATUS_NAME_UNDONE = '未実施';
    public const HOMEWORK_STATUS_NAME_DOING = '実施中';
    public const HOMEWORK_STATUS_NAME_DONE = '完了！';

    public const HOMEWORK_STATUS_OBJECT = [
        self::HOMEWORK_STATUS_UNDONE => self::HOMEWORK_STATUS_NAME_UNDONE,
        self::HOMEWORK_STATUS_DOING => self::HOMEWORK_STATUS_NAME_DOING,
        self::HOMEWORK_STATUS_DONE => self::HOMEWORK_STATUS_NAME_DONE,
    ];

    public const HOMEWORK_STATUS_ARRAY = [
        self::HOMEWORK_STATUS_UNDONE,
        self::HOMEWORK_STATUS_DOING,
        self::HOMEWORK_STATUS_DONE,
    ];
}
