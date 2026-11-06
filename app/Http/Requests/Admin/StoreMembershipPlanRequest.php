<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipPlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trainer_id' => 'nullable|exists:trainers,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'duration_days' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:active,inactive',
        ];
    }
}