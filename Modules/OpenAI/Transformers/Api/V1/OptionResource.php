<?php

namespace Modules\OpenAI\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
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
            'use_ase_id' => $this->use_ase_id,
            'type' => $this->type,
            'key' => $this->key,
            'option_meta' => OptionMetaResource::collection($this->metadata),
        ];
    }
}
