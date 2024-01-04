<?php

namespace Modules\OpenAI\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PreferenceCategoryResource extends JsonResource
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
            'key' => $this->key,
            'value' => processApiPreferenceData($this->key, json_decode($this->value, true))
        ];
    }
}
