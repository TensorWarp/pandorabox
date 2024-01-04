<?php

namespace Modules\OpenAI\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questions' => 'required',
            'useCase' => 'required',
            'language' => 'required',
            'variant' => 'required|max:191',
            'temperature' => 'required',
            'tone' => 'required',
            'stream-data' => ['nullable'],
        ];
    }

}
