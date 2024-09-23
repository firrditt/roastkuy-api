<?php

namespace App\Http\Requests;

use App\Rules\HtmlTags;
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
            'name' =>     ['required', 'max:50', new HtmlTags],
            'email' =>    ['required', 'max:150', 'email', 'unique:accounts,email', new HtmlTags],
            'phone' =>    ['nullable', 'digits_between:9,13', 'unique:accounts,phone'],
            'password' => ['required', Password::min(8)->numbers()]
        ];
    }
}
