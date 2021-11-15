<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        $rules = [
            'name' => 'required|min:5',
            'passwordagain' => 'same:password'
        ];
        if ($this->input('update') == 1) {
            $rules['password'] = ($this->input('password') != NULL) ? 'required|min:6|max:32' : '';
            $rules['email'] = ($this->input('email') != $this->input('oldemail')) ? 'required|email|unique:users,email' : '';
        }else{
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = 'required|min:6|max:32';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must be at least 5 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' =>'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be between 6 and 32 characters!',
            'password.max' => 'The password must be between 6 and 32 characters!',
            'passwordagain.same' => 'The password again and password must match.'
        ];
    }
}
