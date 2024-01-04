<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $favorites = auth()->user()->document_bookmarks_openai ?? [];
        return [
            'id' => $this->id,
            'parent' => $this->parent_id,
            'user' => optional($this->user)->name,
            'use_case_id' => $this->use_case_id,
            'slug' => $this->slug,
            'title' => $this->title,
            'prompt' => $this->prompt,
            'content' => $this->content,
            'tokens' => $this->tokens,
            'words' => $this->words,
            'model' => $this->model,
            'language' => $this->language,
            'cretivityLabel' => $this->creativity_label,
            'is_favorite' => in_array($this->id, $favorites) ? true : false,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
