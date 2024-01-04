<?php

namespace Modules\OpenAI\Filters;

use App\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

class UseCaseFilter extends Filter
{
    protected string $authUserType = 'guest';

    public function __construct()
    {
        $this->authUserType = strtolower(Auth::user()->role()->type);
    }

    public function status($value)
    {
        if ($this->authUserType == 'admin') {
            return $this->query->where('status', $value);
        }

        return $this->query;
    }

    public function useCaseId($id)
    {
        if ($this->authUserType == 'admin') {
            return $this->query->where('id', $id);
        }

        return $this->query;
    }

    public function categoryId($id)
    {
        if (is_numeric($id) && $id > 0) {
            $this->query->whereHas('useCaseCategories', function ($query) use ($id) {
                $query->where('id', $id);
            });
        }

        return $this->query;
    }

    public function isFavorites($value)
    {
        if ($value == 'true') {
            $this->query ->whereIn('id', auth()->user()->use_case_favorites);
        }

        return $this->query;
    }

    public function search($value)
    {
        if (gettype($value) == 'string') {
            $value = xss_clean($value);
        } else if (gettype($value) == 'array') {
            $value = xss_clean($value['value']);
        }

        return $this->query->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', '%' . $value . '%')
                ->OrWhere('description', 'LIKE', '%' . $value . '%')
                ->orWhereHas('user', function ($query) use ($value) {
                    $query->where('name', 'LIKE', '%' . $value . '%');
                });
        });
    }
}
