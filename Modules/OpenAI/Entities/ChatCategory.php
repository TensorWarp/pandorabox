<?php

namespace Modules\OpenAI\Entities;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;

class ChatCategory extends Model
{
    use ModelTrait;

    protected $fillable = ['id', 'name', 'description', 'slug'];

    protected $table = 'chat_categories';

    /**
     * Relation with User Model
     */
    public function chatBots()
    {
        return $this->hasMany(ChatBot::class, 'chat_category_id');
    }
    
}
