<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RendezvousRequest extends FormRequest
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
            'last_name' => ['required', 'min:3'],
            'first_name' => ['required', 'min:3'],
            'email' => ['required', 'email:rfc,dns'],
            'number' => ['numeric', 'min:8'],
            'day' => ['required', 'string'],
            'hour' => ['required', 'string'],
            'duration' => ['required', 'numeric'],
        ];
    }
}
