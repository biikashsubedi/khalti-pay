<?php

namespace App\Http\Requests\Api;

use Config;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as IlluminateFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Request;

class FormRequest extends IlluminateFormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($this->errorUnprocessableMultipleEntity($validator), 422));
    }

    public function errorUnprocessableMultipleEntity($validator, $titleMessage = null)
    {
        $errorData = [];
        foreach ($validator->errors()->toArray() as $key => $value) {
            foreach ($value as $v) {
                $jsonErrorMessage['title'] = $key;
                $jsonErrorMessage['detail'] = $v;
                $errorData[] = $jsonErrorMessage;
            }
        }
        $jsonError['errors'] = $errorData;

        return $this->metaEncode($jsonError);
    }

    protected function metaEncode($response)
    {
        $json1 = json_encode($response, JSON_UNESCAPED_SLASHES);
        $meta = json_encode(Config::get('constants.META'));
        $array1 = json_decode($meta, true);
        $array2 = json_decode($json1, true);
        $data = array_merge_recursive($array1, $array2);

        return $data;
    }
}
