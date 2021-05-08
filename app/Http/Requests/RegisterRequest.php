<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email' => 'required|max:255|email|unique:users',
            'name' => 'required|max:255',
            'password' => 'required|max:255|confirmed',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator,response()->json($validator->errors(), 422),);
    }

}
