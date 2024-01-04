<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;
use App\Traits\ModelTraits\{Filterable};
class Content extends Model
{
    use Filterable;

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * Meta Table
     *
     * @var string
     */
    protected $metaTable = 'content_meta';

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = ['parent_id', 'user_id', 'use_case_id', 'title', 'slug', 'promt', 'content', 'tokens', 'words', 'characters', 'model', 'language', 'tone', 'creativity_label'];

    /**
     * store content
     * @param mixed $data
     *
     * @return [type]
     */
    public function store($data)
    {
        return parent::insert($data);
    }

    /**
     * Foreign key with UseCase model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function useCase()
    {
        return $this->belongsTo('Modules\OpenAI\Entities\UseCase', 'use_case_id');
    }

    /**
     * Foreign key with Option model
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function option()
    {
        return $this->hasMany('Modules\OpenAI\Entities\Option', 'use_case_id', 'use_case_id');
    }

    /**
     * Relation with User Model
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }








}
