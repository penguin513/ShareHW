<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'room_id',
        'day_of_week',
        'name',
        'message',
        'point',
        'add_name',
        'pic_name',
    ];

}
