<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;
use Modules\OpenAI\Entities\OptionMeta;
use Modules\OpenAI\Traits\MetaTrait;
class Option extends Model
{
    use MetaTrait;

    protected $fillable =[
        'use_case_id',
        'type',
        'key'
    ];

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'options';

    /**
     * Meta Table
     *
     * @var string
     */
    protected $metaTable = 'option_meta';

    /**
     * Checks if the meta is already fetched or not
     * @var bool
     */
    protected $metaFetched = false;

    /**
     * Get Data
     *
     * @return Collection
     */
    public static function getAll()
    {
        return self::get();
    }

    /**
     * Get data by id
     *
     * @param int $id
     * @return Collection
     */
    public static function byId($id)
    {
        return self::whereUseCaseId($id)->get();
    }

    /**
     * Relation with Option Meta model
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metadata()
    {
        return $this->hasMany(OptionMeta::class, 'option_id', 'id');
    }
    
}    