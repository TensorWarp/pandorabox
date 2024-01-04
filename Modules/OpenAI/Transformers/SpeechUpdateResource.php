<?php

namespace Modules\OpenAI\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SpeechUpdateResource extends JsonResource
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
            'content' => $this->content
        ];
    }
}
