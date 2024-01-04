<?php

namespace Modules\OpenAI\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PreferenceResource extends JsonResource
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
            'name' => $this->name,
            'meta' => $this->whenLoaded('metaData', function() {
                return PreferenceCategoryResource::collection($this->metaData);
            })
        ];
    }
}
