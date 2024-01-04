<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_2_0;

use Illuminate\Database\Seeder;
use Modules\OpenAI\Entities\ContentType;

class ContentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parentId = ContentType::insertGetId([
            'name' => 'Speech to text',
            'slug' => 'speech_to_text',
        ]);

        \DB::table('content_types_meta')->insert([
            [
                'content_type_id' => $parentId,
                'name' => 'speech_to_text',
                'key' => 'language',
                'value' => '["en","fr","zh","ar","be","bg","ca","et","nl","ru","es","pt"]'
            ],
        ]);
    }
}
