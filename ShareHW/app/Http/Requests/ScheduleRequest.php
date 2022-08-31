<?php

namespace App\Http\Requests;

use App\Models\ScheduleDayofweek;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
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
            'message' => 'nullable | max:500',
            'point' => 'required | integer',
            'pic_name' => 'required | max:100',
            'day_of_week' => ['required', Rule::in(ScheduleDayofweek::SCHEDULE_DAYOFWEEK_ARRAY)],
        ];
    }
}
