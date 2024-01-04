<?php

namespace Modules\OpenAI\Entities;

use Illuminate\Database\Eloquent\Model;

use App\Models\MetaData;
use App\Traits\ModelTrait;


class ContentTypeMeta extends MetaData
{
    use ModelTrait;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'content_types_meta';

    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = ['content_type_id', 'name', 'key', 'value'];

    /**
     * Relation with ContentTypes model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contentType()
    {
        return $this->belongsTo(ContentType::class, 'content_type_id');
    }


}
