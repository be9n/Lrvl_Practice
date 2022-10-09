<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'photo' => 'required',
        ];
    }

    public function messages()
    {
        return $messages = [
            'name.required' => trans('messages.offer name required'),
            'price.required' => __('messages.offer price required'),
            'price.numeric' => __('messages.offer price numeric'),
            'photo.required' => __('messages.offer photo required'),
        ];
    }
}
