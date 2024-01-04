<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('content_types')->delete();
        
        \DB::table('content_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Document',
                'slug' => 'document',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Image Maker',
                'slug' => 'image_maker',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Code Writer',
                'slug' => 'code_writer',
            )
        )
        );
    }
}
