<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EsewaSuccessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'transaction_code' => ['required', 'string'],
            'status' => ['required', 'in:COMPLETE,PENDING,FULL_REFUND,PARTIAL_REFUND,AMBIGUOUS,NOT_FOUND,CANCELED'], // Based on what statuses eSewa sends
            'total_amount' => ['required', 'string'], // If you want to be more strict, use regex or parse float
            'transaction_uuid' => ['required', 'string'],
            'product_code' => ['required', 'string'],
            'signed_field_names' => ['required', 'string'],
            'signature' => ['required', 'string'],
        ];
    }
}
