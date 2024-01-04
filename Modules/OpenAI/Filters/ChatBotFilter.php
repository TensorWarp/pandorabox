<?php

namespace Modules\OpenAI\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class ChatBotFilter extends Filter
{
    public function chatCategory($value)
    {
        return $this->query->where('chat_category_id', $value);
    }

    public function status($value)
    {
        return $this->query->where('status', $value);
    }

    public function search($value)
    {
        $value = xss_clean($value['value']);

        return $this->query->where(function ($query) use ($value) {
            $query->whereLike('status', $value)
                ->orWhereHas('chatCategory', function($q) use ($value) {
                    $q->whereLike('name', $value);
                });
        });
      
    }
}
