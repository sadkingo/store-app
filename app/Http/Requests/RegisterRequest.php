<?php

namespace App\Http\Requests;

use App\Rules\StateCityRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name'=>'required|string|min:2|max:255',
            'username'=>'required|string|unique:users,username|min:5|max:255',
            'password'=>['required','confirmed', Password::defaults()],
            'address'=>'required|string|min:2|max:255',
            'phone'=>'required|numeric|min:10',
            'email'=>'required|email|unique:users,email|min:5|max:50',
            'city'=>['required', new StateCityRule]
        ];
    }
}
