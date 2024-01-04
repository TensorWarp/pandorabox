<?php


namespace Modules\OpenAI\Entities;

use App\Traits\ModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UseCaseCategory extends Model
{
    use ModelTrait;

    protected $table = 'use_case_categories';

    protected $hidden = ['pivot'];

    protected $fillable = ['id', 'name', 'description', 'slug'];

    public function useCases(): BelongsToMany
    {
        return $this->belongsToMany(UseCase::class, 'use_case_use_case_category', 'use_case_category_id', 'use_case_id');
    }
}
