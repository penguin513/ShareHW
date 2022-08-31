<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ItemCategory;
use App\Models\ItemRequired;
use Illuminate\Validation\Rule;


class ItemRequest extends FormRequest
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
            'name' => 'required | max:100',
            'photo' => 'nullable | image | mimes:jpeg,png,jpg | max:3072',
            'message' => 'max:500',
            'category' => ['required', 'integer', Rule::in(ItemCategory::ITEM_CATEGORY_ARRAY)],
            'required' => ['required', Rule::in(ItemRequired::ITEM_REQUIRED_ARRAY)],
        ];
    }
}
