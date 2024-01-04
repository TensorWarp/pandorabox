<?php

namespace Modules\OpenAI\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatAssistantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $subscriptionBots = app('subscriptionBots');
        $botPlan = app('botPlan');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'message' => $this->message,
            'role' => $this->role,
            'promt' => $this->promt,
            'status' => $this->status,
            'is_default' => $this->is_default,
            'created_at' => timeZoneFormatDate($this->created_at) . ' '. timeZoneGetTime($this->created_at),
            'image' => $this->fileUrl(),
            'total_conversation' => \Modules\OpenAI\Services\ChatService::chatConversationWithBot($this->id),
            'plan_name' => !in_array($this->code, json_decode($subscriptionBots) ?? []) ? $botPlan[$this->code] : '',
            'chat_categories' => new ChatBotCategoryResource($this->whenLoaded('chatCategory')),
        ];
    }
}