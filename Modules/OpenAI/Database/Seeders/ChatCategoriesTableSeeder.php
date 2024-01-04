<?php

namespace Modules\OpenAI\Database\Seeders;

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
        
        \DB::table('chat_categories')->delete();
        
        \DB::table('chat_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Free Chat Bot',
                'slug' => 'free-chat-bot',
                'description' => 'Free Chat Bot\'s Description',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Standard Chat Bot',
                'slug' => 'standard-chat-bot',
                'description' => 'Standard Chat Bot\'s Description',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Professional Chat Bot',
                'slug' => 'professional-chat-bot',
                'description' => 'Professional Chat Bot\'s Description',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Premium Chat Bot',
                'slug' => 'premium-chat-bot',
                'description' => 'Premium Chat Bot\'s Description',
            ),
        ));
        
        
    }
}