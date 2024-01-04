<?php

namespace Modules\OpenAI\Entities;

use App\Models\Model;

class OptionMeta extends Model
{

    /**
     * Table
     *
     * @var string
     */
    protected $table = 'option_meta';

    /**
     * Get All Data
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getAll()
    {
        return self::get();
    }

    /**
     * Get Data by Slug
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public static function bySlug($name)
    {
        return self::whereSlug($name)->first();
    }

    /**
     * Foreign key with Option model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option()
    {
        return $this->belongsTo('Modules\OpenAI\Entities\Option', 'option_id');
    }
}
