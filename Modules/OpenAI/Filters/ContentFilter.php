<?php

namespace Modules\OpenAI\Filters;

use App\Filters\Filter;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class ContentFilter extends Filter
{

    public function useCase($value)
    {
        return $this->query->where('use_case_id', $value);
    }

    public function model($value)
    {
        return $this->query->where('model', $value);
    }

    public function userId($id)
    {
        return $this->query->where('user_id', $id);
    }
    
    public function language($id)
    {
        return $this->query->where('language', $id);
    }


    public function search($value)
    {
        $value = xss_clean($value['value']);

        return $this->query->where(function ($query) use ($value) {
            $query->whereLike('model', $value)
                ->orWhereLike('language', $value)
                ->orWhereHas('useCase', function($q) use ($value) {
                    $q->whereLike('name', $value);
                })->orWhereHas('user', function($q) use ($value) {
                    $q->whereLike('name', $value);
                });
        });
      
    }
}
