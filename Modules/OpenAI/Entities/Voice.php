<?php

namespace Modules\OpenAI\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelTraits\hasFiles;
use App\Traits\ModelTraits\{Filterable};

class Voice extends Model
{
    use hasFiles, Filterable;

    protected $fillable = [];
}
