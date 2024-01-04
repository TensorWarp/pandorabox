<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'originalName' => $this->original_name,
            'imageUrl' => $this->imageUrl(),
            'name' => $this->name,
            'slug' => $this->slug,
            'size' => $this->size,
            'artStyle' => $this->art_style,
            'lightingStyle' => $this->lighting_style,
            'created_at' => $this->created_at,
        ];
    }
}
