<?php

namespace App\Http\Requests;

use App\DTOs\UserData;
use App\ValueObjects\Password;
use Illuminate\Foundation\Http\FormRequest;

class CreateUseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ];
    }

    public function toDTO(): UserData
    {
        $data = parent::validated();

        return new UserData(
            name: $data['name'],
            email: $data['email'],
            password: new Password($data['password']),
        );
    }
}
