<?php

namespace App\Http\Requests\Perfis;

use App\DTOs\PerfilData;
use Illuminate\Foundation\Http\FormRequest;

class CreatePerfilRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array',
        ];
    }

    public function toDTO(): PerfilData
    {
        $data = parent::validated();

        return new PerfilData(
            name: $data['name'],
            permissions: $data['permissions'],
        );
    }
}
