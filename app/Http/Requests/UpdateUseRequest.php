<?php

namespace App\Http\Requests;

use App\DTOs\UserData;
use App\ValueObjects\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUseRequest extends FormRequest
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
        #validação
        $rules = [
            'name' => 'required|string|max:255',
            'role_id' => 'required|integer|exists:roles,id',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user,
        ];

        #verifica se a senha foi alterada
        if (!empty($this->input('password'))) {
            $rules['password'] = 'required|string|min:8|confirmed';
            $rules['password_confirmation'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function toDTO(): UserData
    {
        $data = parent::validated();

        $userData = new UserData(
            name: $data['name'],
            email: $data['email'],
            role_id: $data['role_id'],
        );

        if (!empty($data['password'])) {
            $userData->password = new Password($data['password']);
        }

        return $userData;
    }
}
