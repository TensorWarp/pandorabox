<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

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
            'name' => 'Text To Speech',
            'slug' => 'text_to_speech',
        ]);

        \DB::table('content_types_meta')->insert([
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'language',
                'value' => '["English","Bengali","French","Chinese","Arabic","Bulgarian","Catalan","Dutch","Russian","Spanish","Portuguese","Polish","German"]',
            ],
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'volume',
                'value' => '["Low","Default","High"]',
            ],
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'pitch',
                'value' => '["Low","Default","High"]',
            ],
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'speed',
                'value' => '["Super Slow","Slow","Default","Fast","Super Fast"]',
            ],
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'pause',
                'value' => '["0s","1s","2s","3s","4s", "5s"]',
            ],
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'audio_effect',
                'value' => '["Smart Watch","Smartphone","Headphone","Bluetooth","Smart Bluetooth","Smart TV","Car Speaker","Telephone"]',
            ],
            [
                'content_type_id' => $parentId,
                'name' => 'text_to_speech',
                'key' => 'target_format',
                'value' => '["MP3","WAV","OGG"]',
            ],
        ]);

        \DB::table('content_types_meta')->where('id', 1)->update(['value' => '["English","French","Arabic","Byelorussian","Bulgarian","Catalan","Estonian","Dutch","Russian","Spanish","Portuguese","Polish","German"]']);
    }
}
