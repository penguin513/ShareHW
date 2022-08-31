<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class HouseworkSearch extends Model
{
    use HasFactory;

    protected $table = 'houseworks';

    /**
     * houseworksページ内検索機能
     * return $query
     */
    public function scopeSearch($query, $search) {

        $room_id = $search['room_id'] ?? '';
        $name = $search['name'] ?? '';
        $message = $search['message'] ?? '';
        $point = $search['point'] ?? '';
        $pic_name = $search['pic_name'] ?? '';
        $status = $search['status'] ?? '';
        $created_at = $search['created_at'] ?? '';


        if (Auth::user()->role === 1) {
            $query->when($room_id, function ($query, $room_id) {
                $query->where('room_id', $room_id);
            });
        }

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

        $query->when($status, function ($query, $status) {
            $query->where('status', $status);
        });

        $query->when($created_at, function ($query, $created_at) {
            $query->whereDate('created_at', '=', $created_at);
        });

    return $query;

    }



}
