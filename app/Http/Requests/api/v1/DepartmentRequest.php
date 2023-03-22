<?php

namespace App\Http\Requests\api\v1;

class DepartmentRequest extends CustomFormRequest
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
            'name' => ['required', 'min:3', 'max:50']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => "Le nom est obligatoire !",
            'name.min' => "Le nom doit contenir au moins 3 caractères",
            'name.max' => "Le nom doit contenir au max 50 caractères"
        ];
    }
}
