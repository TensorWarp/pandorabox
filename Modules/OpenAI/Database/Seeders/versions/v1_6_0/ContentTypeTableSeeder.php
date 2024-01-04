<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_6_0;

use Illuminate\Database\Seeder;
use Modules\OpenAI\Entities\ContentTypeMeta;

class ContentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContentTypeMeta::where('name', 'image_maker')->where('key', 'resulation')->update([
            'value' => '["1024x1024", "1024x1792", "1792x1024"]'
        ]);

        ContentTypeMeta::where('name', 'document')->where('key', 'language')->update([
            'value' => '["English","French","Arabic","Byelorussian","Bulgarian","Catalan","Estonian","Dutch","Russian","Spanish","Portuguese","Polish","German","Sweden"]'
        ]);
        
        ContentTypeMeta::where('name', 'speech_to_text')->where('key', 'language')->update(['value' => '["en","fr","ar","bg","ca","et","nl","ru","es","pt","pl","de","sv"]']);
        

        ContentTypeMeta::where('name', 'text_to_speech')->where('key', 'language')->update(['value' => '["English","Bengali","French","Chinese","Arabic","Bulgarian","Catalan","Dutch","Russian","Spanish","Portuguese","Polish","German","Sweden"]']);
        
    }
}
