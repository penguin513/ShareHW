<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ItemSearch extends Model
{
    use HasFactory;

    protected $table = 'items';

    /**
     * itemsページ内検索機能
     * return $query
     */
    public function scopeSearch($query, $search) {

        $room_id = $search['room_id'] ?? '';
        $name = $search['name'] ?? '';
        $message = $search['message'] ?? '';
        $category = $search['category'] ?? '';
        $required = $search['required'] ?? '';
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

        $query->when($category, function ($query, $category) {
            $query->where('category', $category);
        });

        $query->when($required, function ($query, $required) {
            $query->where('required', $required);
        });

        $query->when($created_at, function ($query, $created_at) {
            $query->whereDate('created_at', '=', $created_at);
        });

    return $query;

    }
}
