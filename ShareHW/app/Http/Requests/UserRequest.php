<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\UserArea;
use App\Models\User;



class UserRequest extends FormRequest
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
    public function rules(Request $request)
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
                    ->whereNot('email', User::find($request->id)->email)
            ],
            'room_id' => ['required', 'regex:/^[0-9]+$/i', 'size:12'],
            'area' => ['nullable', 'regex:/^[0-9]+$/i', Rule::in(UserArea::USER_AREA_ARRAY)],
            'role' => ['required', 'numeric', Rule::in(UserRole::USER_ROLE_ARRAY)],
        ];
    }
}
