<?php

namespace Modules\OpenAI\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Support\{Arr, Str};
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChatCategoryRequest extends FormRequest
{
    use ApiResponse;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:191', Rule::unique('chat_categories', 'name')->ignore($this->id)],
            'slug' => ['required', 'max:191', Rule::unique('chat_categories', 'slug')->ignore($this->id)],
            'description' => 'required|string|max:1000'
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.min' => __('Name should be at least of 2 characters.'),
            'name.max' => __('Name should not be more than 191 characters.'),
            'name.unique' => __('Category with this name already exists!'),
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     */
    public function failedValidation(Validator $validator): void
    {
        if (Str::startsWith(request()->path(), 'api') || request()->wantsJson()) {
            $apiResponse = $this->errorResponse(Arr::flatten(json_decode($validator->errors(), true)), 422, __('Validation failed!'));
            throw new HttpResponseException($apiResponse);
        }

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
    
}
