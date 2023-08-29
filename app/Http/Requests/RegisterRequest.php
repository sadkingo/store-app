<?php

namespace App\Http\Requests;

use App\Rules\StateCityRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
    {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
        {
        return true;
        }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public static function rules($userId = null) : array
        {
        return [
            'full_name' => 'required|string|min:2|max:255',
            'username'  => ['required', 'string', 'min:5', 'max:255'
                , Rule::unique('users', 'username')->ignore($userId),],
            'password'  => ['required', 'confirmed', Password::defaults()],
            'address'   => 'required|string|min:2|max:255',
            'phone'     => 'required|numeric|min:10',
            'email'     => ['required', 'email', 'min:5', 'max:50'
                , Rule::unique('users', 'email')->ignore($userId),],
            'city'      => ['required', new StateCityRule],
        ];
        }
    }
