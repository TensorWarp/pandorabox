<?php

namespace Modules\OpenAI\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Support\{Arr, Str};
use Modules\OpenAI\Entities\UseCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UseCaseRequest extends FormRequest
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
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if (!empty($this->name)) {
            $this->merge(['slug' => $this->generateSlug()]);
        }

        if (empty($this->category_id_array)) {
            request()->merge(['category_id_array' => []]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:2|max:191',
            'slug' => ['required', Rule::unique('use_cases', 'slug')->ignore($this->id)],
            'description' => 'required|max:1000',
            'names' => 'required|max:191',
            'variable_names' => ['array'],
            'descriptions' => 'required|max:191',
            'type' => 'required',
            'input_template' => ['required', 'string'],
            'category_id_array' => 'nullable|array',
            'category_id_array.*' => 'numeric',
            'file' => ['nullable', 'file', 'image', 'max:1024'],
            'file_id'  => ['nullable', 'array'],
            'file_id.*'  => ['nullable', 'numeric'],
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages(): array
    {
        return [
            'name.required' => __('Name is required!'),
            'name.min' => __('Name should be at least of 2 characters.'),
            'name.max' => __('Name should not be more than 150 characters.'),
            'input_template.required' => __('Input template is mandatory!'),
            'category_id_array.array' => __('Must be a array of category id\'s.'),
            'category_id_array.*.numeric' => __('Category id must be a number.'),
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

    /**
     * Generate slug
     */
    public function generateSlug(): string
    {
        $slug = Str::slug($this->name);

        if (!empty($this->id) && is_numeric($this->id) && $model = UseCase::find($this->id)) {
            if ($model->name === $this->name) {
                $slug = $model->slug;
            }

            if (UseCase::whereKeyNot([$this->id])->whereSlug($slug)->exists()) {
                $slug = $this->generateUniqueSlug($slug);
            }
        } else if (UseCase::whereSlug($slug)->exists()) {
            $slug = $this->generateUniqueSlug($slug);
        }

        return $slug;
    }

    /**
     * Generate unique slug
     *
     * @param  string  $slug
     */
    public function generateUniqueSlug($slug): string
    {
        return $slug . '-' . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 5);
    }
}
