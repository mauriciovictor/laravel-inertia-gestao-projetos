<?php

namespace App\Http\Requests\Projects\Cards\Items;

use App\DTOs\ProjectCardData;
use App\DTOs\ProjectCardItemData;
use App\DTOs\ProjectData;
use App\Enums\ProjectStatusEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCardItemRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|string',
            'card_id' => 'required|exists:projects_cards,id',
        ];
    }

    public function toDTO(): ProjectCardItemData
    {
        $data = parent::validated();

        return new ProjectCardItemData(
            card_id: $data['card_id'],
            title: $data['title'],
            description: $data['description'],
            priority: $data['priority'],
        );
    }
}
