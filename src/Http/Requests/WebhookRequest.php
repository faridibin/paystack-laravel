<?php

declare(strict_types=1);

namespace Faridibin\PaystackLaravel\Http\Requests;

use Faridibin\Paystack\Enums\WebhookEvent;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

/**
 * Form request for validating incoming Paystack webhook payloads.
 *
 * Ensures the `event` field is a recognized Paystack webhook event type
 * and that `data` is present as an array.
 */
class WebhookRequest extends FormRequest
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
            'event' => ['required', 'string', Rule::in(WebhookEvent::values())],
            'data' => ['present', 'array'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new Response('Validation failed:' . $validator->errors()->toJson(), 422);

        throw new HttpResponseException($response);
    }
}
