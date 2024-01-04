<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContentTypeMetaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('content_types_meta')->delete();
        
        \DB::table('content_types_meta')->insert(array (
            0 => 
            array (
                'id' => 1,
                'content_type_id' => 1,
                'name' => 'document',
                'key' => 'language',
                'value' => '["English","French","Chinese","Arabic","Byelorussian","Bulgarian","Catalan","Estonian", "Dutch"]'
            ),
            1 => 
            array (
                'id' => 2,
                'content_type_id' => 1,
                'name' => 'document',
                'key' => 'tone',
                'value' => '["Casual","Funny","Bold","Femenine"]'
            ),
            2 => 
            array (
                'id' => 3,
                'content_type_id' => 1,
                'name' => 'document',
                'key' => 'variant',
                'value' => '["1","2","3"]'
            ),
            3 => 
            array (
                'id' => 4,
                'content_type_id' => 1,
                'name' => 'document',
                'key' => 'temperature',
                'value' => '["Optimal","Low","Medium","High"]'
            ),
            4 => 
            array (
                'id' => 5,
                'content_type_id' => 2,
                'name' => 'image_maker',
                'key' => 'variant',
                'value' => '["1","2","3"]'
            ),
            5 => 
            array (
                'id' => 6,
                'content_type_id' => 2,
                'name' => 'image_maker',
                'key' => 'resulation',
                'value' => '["256x256","512x512","1024x1024"]'
            ),
            6 => 
            array (
                'id' => 7,
                'content_type_id' => 2,
                'name' => 'image_maker',
                'key' => 'artStyle',
                'value' => '["Normal","Cartoon art","3D Render","Pixel art","Isometric","Vendor art","Line art","Watercolor art","Anime art"]'
            ),
            7 => 
            array (
                'id' => 8,
                'content_type_id' => 2,
                'name' => 'image_maker',
                'key' => 'lightingStyle',
                'value' => '["Normal","Studio","Warm","Cold","Ambient","Neon","Foggy"]'
            ),
            8 => 
            array (
                'id' => 9,
                'content_type_id' => 3,
                'name' => 'code_writer',
                'key' => 'language',
                'value' => '["PHP","Java","Rubby", "Python", "C#", "Go", "Kotlin", "Javascript", "TypeScript", "SQL", "NoSQL"]'
            ),
            9 => 
            array (
                'id' => 10,
                'content_type_id' => 3,
                'name' => 'code_writer',
                'key' => 'codeLabel',
                'value' => '["Noob","Moderate","High"]'
            ),
            10 => 
            array (
                'id' => 11,
                'content_type_id' => 2,
                'name' => 'image_maker',
                'key' => 'imageCreateFrom',
                'value' => '["Openai"]'
            ),
        )
        );
    }
}
