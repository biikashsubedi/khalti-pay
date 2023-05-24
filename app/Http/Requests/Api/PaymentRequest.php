<?php

namespace App\Http\Requests\Api;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentRequest extends FormRequest
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
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'payment' => 'required|in:' . Payment::$khalti,
            'id' => 'required|max:100',
            'name' => 'required|max:100',
            'amount' => 'required|int|max:99999',
        ];
    }
}
