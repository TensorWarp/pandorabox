<?php

namespace Modules\OpenAI\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\OpenAI\Traits\PreferenceTrait;

class ContentType extends Model
{
    use PreferenceTrait;

    /**
     * Fillable
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * timestamps
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Relation with ContentTypeMeta model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metaData()
    {
        return $this->hasMany(ContentTypeMeta::class, 'content_type_id', 'id');
    }



}
