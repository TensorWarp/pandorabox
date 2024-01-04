<?php


namespace Modules\OpenAI\Traits;

use Modules\OpenAI\Entities\ContentType;

trait PreferenceTrait
{
    public function __get($name)
    {
        $val = parent::__get($name);

        if ($val <> null) {
            return $val;
        }

        $data = $this->metaData()->where('key', $name)->first();

        if ($data) {
            return $data->value;
        }
    }

    public static function getData($slug = null)
    {
        $data = [];
        $prefArr = [ 'document', 'image_maker', 'code_writer', 'speech_to_text', 'text_to_speech'];

        if ( in_array($slug, $prefArr) ) {
            $data = ContentType::with('metaData')->where('slug', $slug)->first();
        }
        
        return $data;
    }
}
