<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;
use App\Traits\ModelTraits\{Filterable};
use App\Traits\ModelTraits\hasFiles;
class Image extends Model
{
    use Filterable, hasFiles;

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * Relation with User Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
