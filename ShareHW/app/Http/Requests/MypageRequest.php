<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\UserArea;
use App\Models\UserColor;
use Illuminate\Support\Facades\Auth;


class MypageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')
                    ->whereNull('deleted_at')
                    ->whereNot('email', Auth::user()->email),
            ],
            'room_id' => ['required', 'regex:/^[0-9]+$/i', 'size:12'],
            'area' => ['nullable', 'regex:/^[0-9]+$/i', Rule::in(UserArea::USER_AREA_ARRAY)],
            'color' => ['required', 'regex:/^[0-9]+$/i', Rule::in(UserColor::USER_COLOR_ARRAY)],
        ];
    }
}
