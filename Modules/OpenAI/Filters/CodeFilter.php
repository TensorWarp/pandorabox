<?php

namespace Modules\OpenAI\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class CodeFilter extends Filter
{

    public function userId($id)
    {
        return $this->query->where('user_id', $id);
    }


    public function search($value)
    {
        $value = xss_clean($value['value']);

        return $this->query->where(function ($query) use ($value) {
            $query->whereLike('promt', $value)
                ->orWhereHas('user', function($query) use ($value) {
                    $query->whereLike('name', $value);
                }
            );
        });
      
    }
}
