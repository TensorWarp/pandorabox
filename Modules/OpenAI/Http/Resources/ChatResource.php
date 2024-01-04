<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            'user_message' => $this->user_message,
            'bot_name' => $this->chatBot?->name,
            'bot_message' => $this->bot_message,
            'tokens' => $this->tokens,
            'words' => $this->words,
            'characters' => $this->characters,
            'created_at' => timeZoneFormatDate($this->created_at) . ' '. timeZoneGetTime($this->created_at),
            'bot_image' => $this->chatBot?->fileUrl(),
        ];
    }
}
