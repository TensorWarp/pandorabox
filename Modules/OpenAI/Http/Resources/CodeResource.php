<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => optional($this->user)->name,
            'model' => $this->model,
            'promt' => $this->promt,
            'language' => $this->language,
            'code_label' => $this->code_label,
            'slug' => $this->slug,
            'code' => $this->code,
            'tokens' => $this->tokens,
            'words' => $this->words,
            'characters' => $this->characters,
            'created_at' => $this->created_at
        ];
    }
}
