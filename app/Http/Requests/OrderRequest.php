<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
            'order_number' => ['required', 'string', 'max:50'],
            'order_event_id' => ['required', 'integer', 'exists:events,event_id'],
            'order_price' => ['required', 'numeric', 'gte:0'],
            'order_type' => ['required', 'string', 'max:50'],
            'order_payment' => ['required', 'string'],
            'order_info' => ['required', 'string'],
            'order_created_on' => ['required', 'date'],
            'order_client_id' => ['nullable', 'integer'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Erreur de validation',
                'data' => $validator->errors(),
            ]),
        );
    }
}
