<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EventRequest extends FormRequest
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
            'event_category' => ['required'],
            'event_title' => ['required', 'string'],
            'event_description' => ['string'],
            'event_date' => ['date'],
            'event_image' => ['string'],
            'event_city' => ['string'],
            'event_address' => ['string'],
            'event_status' => ['string'],
            'event_created_on' => ['date'],
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
