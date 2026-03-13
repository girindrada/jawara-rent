<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfficeSpaceRequest extends FormRequest
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
            'name' => ['required','string', 'max:255'],
            'thumbnail' => ['sometimes', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'about' => ['required', 'string'],
            'city_id' => ['required', 'exists:cities,id'],
            'is_open' => ['sometimes', 'boolean'],
            'is_full_booked' => ['sometimes', 'boolean'],
            'price' => ['required', 'numeric'],
            'duration' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }
}
