<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatConversationResource extends JsonResource
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
            'user_name' => $this->user?->name,
            'title' => $this->title,
            'created_at' => timeZoneFormatDate($this->created_at) . ' '. timeZoneGetTime($this->created_at)
        ];
    }
}
