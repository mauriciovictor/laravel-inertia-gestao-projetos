<?php

namespace App\Http\Requests\Projects\Cards;

use App\DTOs\ProjectCardData;

class UpdateCardRequest
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
        $this->merge(['project' => $this->project]);

        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project' => 'required|exists:projects,id',
        ];
    }

    public function toDTO(): ProjectCardData
    {
        $data = parent::validated();

        return new ProjectCardData(
            project_id: $data['project'],
            title: $data['title'],
            description: $data['description'],
        );
    }
}
