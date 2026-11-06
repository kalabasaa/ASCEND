<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'payment_type' => 'required|in:subscription,sale',
            'subscription_id' => 'required_if:payment_type,subscription|nullable|exists:member_subscriptions,id',
            'sale_id' => 'required_if:payment_type,sale|nullable|exists:sales,id',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string|max:50',
            'payment_date' => 'required|date',
            'reference_number' => 'nullable|string|max:255',
        ];
    }
}