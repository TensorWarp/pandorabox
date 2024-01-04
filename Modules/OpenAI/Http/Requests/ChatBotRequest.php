<?php

namespace Modules\OpenAI\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Support\{Arr, Str};
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Rules\CheckValidFile;


class ChatBotRequest extends FormRequest
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
            
            'chat_category_id' => 'required',
            'name' => ['required', 'string', 'min:2', 'max:191', Rule::unique('chat_bots', 'name')->ignore($this->id)],
            'code' => ['required', Rule::unique('chat_bots', 'code')->ignore($this->id)],
            'message' => 'required|max:191',
            'role' => 'required',
            'promt' => 'required',
            'status' => 'required|in:Active,Inactive',
            'is_default' => 'required|in:1,0',
            'image'  => ['nullable', new CheckValidFile(getFileExtensions(3))],
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
            'name.unique' => __('Chat bot with this name already exists!'),
            'promt.max' => __('Prompt should not be more than 191 characters.')
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
