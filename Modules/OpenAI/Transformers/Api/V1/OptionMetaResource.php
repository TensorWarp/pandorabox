<?php

namespace Modules\OpenAI\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionMetaResource extends JsonResource
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
            'option_id' => $this->option_id,
            'key' => $this->key,
            'value' => $this->value,
        ];
    }
}
