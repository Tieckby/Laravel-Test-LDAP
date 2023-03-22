<?php

namespace App\Http\Requests\api\v1;

class SigninRequest extends CustomFormRequest
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
            'usernameOrEmailOrPhoneNumber' => ['required', 'min:3', 'max:50'],
            'password' => ['required'],
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
            'usernameOrEmailOrPhoneNumber.required' => "Le nom d'utilisateur est obligatoire !",
            'usernameOrEmailOrPhoneNumber.min' => "Ce champ doit contenir au moins 3 caractères",
            'usernameOrEmailOrPhoneNumber.max' => "Ce champ doit contenir au max 50 caractères",

            'password.required' => "Le nom d'utilisateur est obligatoire !",
        ];
    }
}
