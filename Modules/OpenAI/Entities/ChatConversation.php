<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;
class ChatConversation extends Model
{

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'chat_conversations';

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
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function chats()
    {
        return $this->hasMany(Chat::class, 'chat_conversation_id');
    }
}
