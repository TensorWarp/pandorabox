<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeechResource extends JsonResource
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
            'user_id' => optional($this->user)->id,
            'content' => $this->content,
            'duration' => $this->duration,
            'language' => $this->language,
            'audio' => $this->audioUrl(),
            'file_size' => $this->file_size,
            'original_file_name' => $this->original_file_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
