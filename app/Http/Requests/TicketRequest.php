<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TicketRequest extends FormRequest
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
            'ticket_event_id' => ['required', 'integer'],
            'ticket_email' => ['required', 'email'],
            'ticket_phone' => ['required', 'string', 'max:20'],
            'ticket_price' => ['required', 'numeric'],
            'ticket_order_id' => ['required', 'integer'],
            'ticket_order_id' => ['required', 'integer'],
            'ticket_key' => ['required', 'string'],
            'ticket_ticket_type_id' => ['required', 'integer'],
            'ticket_status' => ['required', 'string'],
            'ticket_created_on' => ['required', 'date'],
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
