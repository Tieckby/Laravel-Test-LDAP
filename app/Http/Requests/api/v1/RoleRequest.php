<?php

namespace App\Http\Requests\api\v1;

class RoleRequest extends CustomFormRequest
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
            'roleName' => ['required', 'min:3', 'max:50']
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
            'roleName.required' => "Le nom du rôle est obligatoire !",
            'roleName.min' => "Le nom du rôle doit contenir au moins 3 caractères",
            'roleName.max' => "Le nom du rôle doit contenir au max 50 caractères"
        ];
    }
}
