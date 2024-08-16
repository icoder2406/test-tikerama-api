<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketTypeRequest extends FormRequest
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
            'ticket_type_event_id' => ['required', 'integer', 'exists:events,event_id'],
            'ticket_type_name' => ['required', 'string'],
            'ticket_type_price' => ['required', 'numeric', 'gte:0'],
            'ticket_type_quantity' => ['required', 'integer', 'gte:0'],
            'ticket_type_real_quantity' => ['required', 'integer', 'gte:0'],
            'ticket_type_total_quantity' => ['required', 'integer', 'gte:0'],
            'ticket_type_description' => ['string'],
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
