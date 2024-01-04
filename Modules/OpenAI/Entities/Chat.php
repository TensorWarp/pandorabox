<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;

class Chat extends Model
{
    protected $table = 'chats';

    /**
     * Relation with User Model
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

     /**
     * Relation with ContentTypes model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatBot()
    {
        return $this->belongsTo(ChatBot::class, 'bot_id');
    }

     /**
     * Relation with ContentTypes model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chatConversation()
    {
        return $this->belongsTo(ChatConversation::class, 'chat_conversation_id');
    }
}    