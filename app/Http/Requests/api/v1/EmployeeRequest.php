<?php

namespace App\Http\Requests\api\v1;

class EmployeeRequest extends CustomFormRequest
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
            'fullName' => [],
            'username' => ['required', 'min:3', 'max:50'],
            'email' => ['required', 'email', 'regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix'],
            'phoneNumber' => [],
            'password' => [],
            'email_verified' => ['required', 'boolean'],
            'department_id' => ['required', 'integer'],
            'role_id' => ['required', 'integer']
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
            'username.required' => "Le nom d'utilisateur est obligatoire !",
            'username.min' => "Ce champ doit contenir au moins 3 caractères",
            'username.max' => "Ce champ doit contenir au max 50 caractères",

            'email.required' => "L'email est obligatoire !",
            'email.email' => "Veuillez entrer le bon format d'e-mail !",
            'email.regex' => "Veuillez entrer le bon format d'e-mail !",

            'email_verified.required' => "Ce champ est obligatoire !",
            'email_verified.boolean' => "Ce champ doit être une valeur booléen !",

            'department_id.required' => "Ce champ est obligatoire !",
            'department_id.integer' => "Ce champ doit être une valeur entière !",

            'role_id.required' => "Ce champ est obligatoire !",
            'role_id.integer' => "Ce champ doit être une valeur entière !",
        ];
    }
}
