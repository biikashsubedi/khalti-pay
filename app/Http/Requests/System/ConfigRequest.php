<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

class ConfigRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
//            'label' => 'required|unique:configs,label',
            'value' => 'required',
//            'type' => 'required|in:text,textarea,file,number,boolean',
        ];
    }
}
