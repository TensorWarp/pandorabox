<?php

namespace Modules\OpenAI\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTraits\{Filterable};
use App\Traits\ModelTraits\hasFiles;
class Audio extends Model
{
    use hasFiles, Filterable;
    protected $table = 'audios';

    /**
     * Relation with User Model
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
