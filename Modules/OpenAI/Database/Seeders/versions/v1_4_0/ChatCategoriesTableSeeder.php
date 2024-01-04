<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;

class ChatCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('chat_categories')->insert([
            [
                'name' => 'Others',
                'slug' => 'others',
                'description' => 'Not having been sorted into a category.',
            ]
        ]);

        \DB::table('chat_bots')->where('id', 1)->update(['is_default' => 1]);
        
    }
}