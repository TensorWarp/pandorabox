<?php

declare(strict_types=1);

namespace Domain\Users\Models\Translation;

use Illuminate\Database\Eloquent\Model;

class AiContentTemplateTranslation extends Model
{

    protected $table = 'ai_content_template_translations';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];
}
