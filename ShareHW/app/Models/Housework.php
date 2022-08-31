<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housework extends Model
{
    use HasFactory;

    protected $table = 'houseworks';

    protected $fillable = [
        'room_id',
        'name',
        'message',
        'point',
        'add_name',
        'pic_name',
        'status',
    ];

}
