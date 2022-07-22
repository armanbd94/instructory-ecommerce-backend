<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordFormRequest extends FormRequest
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
            'current_password'=>'required|min:8',
            'password'=>'required|min:8|confirmed',
            'password_confirmation'=>'required|min:8',
        ];
    }

    public function messages(){
        return [
            'password.required' => 'The new password field is required',
            'password.min' => 'The new password field value length minimum 8 character',
            'password.confirmed' => 'The new password and confirm password field value not match',
            'password_confirmation.required' => 'The password confirmation field is required',
            'password_confirmation.min' => 'The password confirmation field value length minimum 8 character',
        ];
    }
}
