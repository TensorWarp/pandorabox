<?php


namespace Modules\OpenAI\Entities;

use App\Models\Model;
use App\Traits\ModelTrait;
use App\Traits\ModelTraits\{Filterable, hasFiles};
use Modules\MediaManager\Http\Models\ObjectFile;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
Use Modules\OpenAI\Entities\Option;

class UseCase extends Model
{
    use ModelTrait, hasFiles, Filterable;

    protected $table = 'use_cases';

    protected $hidden = ['pivot'];

    protected $fillable = ['name', 'description', 'slug', 'status', 'prompt', 'creator_type', 'creator_id'];

    public function useCaseCategories(): BelongsToMany
    {
        return $this->belongsToMany(UseCaseCategory::class, 'use_case_use_case_category', 'use_case_id', 'use_case_category_id');
    }

    public static function clearFootprints(UseCase $useCase): void
    {
        $useCase->useCaseCategories()->sync([]);
        ObjectFile::where('object_type', '=', 'use_cases')->where('object_id', $useCase->id)->delete();
    }

    public static function getAll()
    {
        return self::where('status', 'Active')->get();
    }


    public static function bySlug($name)
    {
        return self::whereSlug($name)->first();
    }

    public function option()
    {
        return $this->hasMany(Option::class, 'use_case_id');
    }

    public function objectImage()
    {
        return $this->hasOne('Modules\MediaManager\Http\Models\ObjectFile', 'object_id')->where('object_type', 'use_cases');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }

    public static function useCaseCount()
    {
        return UseCase::where('status', 'active')->count();
    }

    public function showUseCaseCount()
    {
        $useCase = $this->useCaseCount();
        return $useCase > 0 ? $useCase - 1 . '+' : 0;
    }
}
