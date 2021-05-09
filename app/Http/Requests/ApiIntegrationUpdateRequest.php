<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ApiIntegrationUpdateRequest extends FormRequest
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
            'integration' => 'required|exists:integrations,id',
            'marketplace' => 'required|max:255|unique:integrations,id,' . $this->integration,
            'username' => 'required|max:255',
            'password' => 'required|max:255'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator, response()->json($validator->errors(), 422),);
    }

    public function validationData(): array
    {
        return array_merge($this->all(),$this->route()->parameters());
    }
}
