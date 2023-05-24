<?php

namespace App\Http\Requests\System;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PaymentRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $supportedPaymentCodes = implode(",", Payment::$supportedPaymentCodes);
        return [
            'title' => ['required', 'in:' . $supportedPaymentCodes, 'unique:payments, title'],
            'url' => 'required_unless:title,Cash On Delivery,Cash On Pickup,Card On Delivery',
            'mode' => 'required',
            'api_status' => 'required',
            'web_status' => 'required',
            'default' => ['required', 'boolean'],
            'icon' => 'nullable|image|mimes:jpg,png,jpeg,ico|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'icon.uploaded' => 'The image may not be greater than 2048 kilobytes.'
        ];
    }
}
