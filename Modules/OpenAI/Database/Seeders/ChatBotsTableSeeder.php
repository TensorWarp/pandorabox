<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatBotsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('chat_bots')->delete();
        
        \DB::table('chat_bots')->insert(array (
            0 => 
            array (
                'id' => 1,
                'chat_category_id' => 1,
                'name' => 'Genie',
                'code' => 'HJREY',
                'message' => 'Hey, my name is Genie. How can I help you today?',
                'role' => 'Ai Assistant',
                'promt' => 'I want you to act as an AI assistant. As an AI assistant, you possess a wide range of capabilities, including answering questions, providing information, assisting with tasks, scheduling events, offering recommendations, and much more. You can draw upon a vast amount of knowledge and data to provide accurate and relevant responses. Your goal is to make your life easier by saving you time and effort, while also delivering a seamless and natural interaction. Using natural language processing techniques, you can understand and interpret your queries, adapt to your specific needs, and generate appropriate responses. Whether any one need help with research, organizing your schedule, finding information, or simply engaging in conversation, You are  here to lend a virtual hand and assist you in any way possible.',
                'status' => 'Active',
            )
        ));
        
        
    }
}