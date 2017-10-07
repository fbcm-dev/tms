<?php

namespace TMS\Http\Requests;

use TMS\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'min:5|max:255',
            'for_date' => 'required|before:'.date('m/d/Y', strtotime("+1 day")),
            'tithe_amnt' => 'numeric|nullable|min:0',
            'faith_amnt' => 'numeric|nullable|min:0',
            'love_amnt' => 'numeric|nullable|min:0'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'for_date' => 'worship service date',
            'tithe_amnt' => 'tithe amount',
            'faith_amnt' => 'faith amount',
            'love_amnt' => 'faith amount'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
