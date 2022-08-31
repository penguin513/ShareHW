<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSearch extends Model
{
    use HasFactory;

    protected $table = 'users';

    /**
     * usersページ内検索機能
     * return $query
     */
    public function scopeSearch($query, $search) {

        $name = $search['name'] ?? '';
        $email = $search['email'] ?? '';
        $room_id = $search['room_id'] ?? '';
        $area = $search['area'] ?? '';
        $role = $search['role'] ?? '';
        $created_at = $search['created_at'] ?? '';


        $query->when($name, function ($query, $name) {
            $query->where('name', 'like', "%$name%");
        });

        $query->when($email, function ($query, $email) {
            $query->where('email', 'like', "%$email%");
        });

        $query->when($room_id, function ($query, $room_id) {
            $query->where('room_id', 'like', "%$room_id%");
        });

        $query->when($area, function ($query, $area) {
            $query->where('area', $area);
        });

        $query->when($role, function ($query, $role) {
            $query->where('role', $role);
        });

        $query->when($created_at, function ($query, $created_at) {
            $query->whereDate('created_at', '=', $created_at);
        });

    return $query;

    }
}
