<?php

namespace Modules\OpenAI\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class VoiceFilter extends Filter
{

    public function gender($data)
    {
        return $this->query->where('gender', $data);
    }
    
    public function language($name)
    {
        return $this->query->where('language_code', 'like', $name . '%');
    }


    public function search($value)
    {
        $value = xss_clean($value['value']);

        return $this->query->where(function ($query) use ($value) {
            $query->where('language_code', 'LIKE', $value . '%')
                ->OrWhere('name', 'LIKE', '%' . $value . '%')
                ->OrWhere('status', 'LIKE', '%' . $value . '%');
        });
    }
}
