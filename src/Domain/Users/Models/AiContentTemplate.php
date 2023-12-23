<?php

declare(strict_types=1);

namespace Domain\Users\Models;

use Domain\Users\Models\User;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AiContentTemplate extends Model implements TranslatableContract
{
    use Translatable;

    protected $table = "ai_content_templates";
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    public $translatedAttributes = ['title', 'prompt'];

    public function getTitleAttribute()
    {
        return getTranslateAttributeValue($this, 'title');
    }

    public function getPromptAttribute()
    {
        return getTranslateAttributeValue($this, 'prompt');
    }

    /********
     * Relations
     * ******/

    public function contents()
    {
        return $this->hasMany(AiContent::class, 'service_id', 'id');
    }
}
