<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ScheduleSearch extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    /**
     * scheduleページ内検索機能
     * return $query
     */
    public function scopeSearch($query, $search) {

        $room_id = $search['room_id'] ?? '';
        $day_of_week = $search['day_of_week'] ?? '';
        $name = $search['name'] ?? '';
        $message = $search['message'] ?? '';
        $point = $search['point'] ?? '';
        $pic_name = $search['pic_name'] ?? '';
        $created_at = $search['created_at'] ?? '';


        if (Auth::user()->role === 1) {
            $query->when($room_id, function ($query, $room_id) {
                $query->where('room_id', $room_id);
            });
        }

        $query->when($day_of_week, function ($query, $day_of_week) {
            $query->where('day_of_week', $day_of_week);
        });

        $query->when($name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        });

        $query->when($message, function ($query, $message) {
            $query->where('message', 'like', "%$message%");
        });

        $query->when($point, function ($query, $point) {
            $query->where('point', $point);
        });

        $query->when($pic_name, function ($query, $pic_name) {
            $query->where('pic_name', $pic_name);
        });

        $query->when($created_at, function ($query, $created_at) {
            $query->whereDate('created_at', '=', $created_at);
        });

    return $query;

    }



}
