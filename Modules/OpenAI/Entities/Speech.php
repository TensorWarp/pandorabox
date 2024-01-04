<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;

use App\Traits\ModelTraits\{Filterable};
use App\Traits\ModelTraits\hasFiles;

class Speech extends Model
{
    use Filterable, hasFiles;

    protected $table = 'speeches';

    protected $fillable = ['user_id', 'content', 'words', 'language', 'file_name', 'file_size', 'original_file_name'];
    
    /**
     * store speech
     * @param mixed $data
     *
     * @return [type]
     */
    public function store($data)
    {
        return parent::insert($data);
    }

    /**
     * Relation with User Model
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
