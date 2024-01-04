<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        
        $menuItemId = DB::table('menu_items')->insertGetId([
            'label' => 'Chat Templates',
            'link' => NULL,
            'params' => NULL,
            'is_default' => 0,
            'icon' => 'fas fa-file-alt',
            'parent' => 0,
            'sort' => 2,
            'class' => NULL,
            'menu' => 1,
            'depth' => 0,
            'is_custom_menu' => 0
        ]);

        DB::table('menu_items')->insert([
            [
                'label' => 'Chat Categories',
                'link' => 'chat/categories',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\ChatCategoriesController@index","route_name":["admin.chat.category.list", "admin.chat.category.create", "admin.chat.category.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => $menuItemId,
                'sort' => 1,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
            [
                'label' => 'Chat Assistants',
                'link' => 'chat/assistants',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\ChatAssistantsController@index","route_name":["admin.chat.assistant.list", "admin.chat.assistant.create", "admin.chat.assistant.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => $menuItemId,
                'sort' => 2,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ]
        ]);

        $parentId = DB::table('menu_items')->insertGetId(
            [
                'label' => 'AI Voices',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fas fa-file-audio',
                'parent' => 0,
                'sort' => 12,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'is_custom_menu' => 0
            ]
        );

        DB::table('menu_items')->insert([
            [
                'label' => 'Voice Verse',
                'link' => 'text-to-speech/voice/list',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\TextToSpeechController@allVoices","route_name":["admin.features.textToSpeech.voice.lists", "admin.features.textToSpeech.voice.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => $parentId,
                'sort' => 0,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
        ]);

        DB::table('menu_items')->upsert([
            [
                'label' => 'Voiceover',
                'link' => 'text-to-speech/list',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\TextToSpeechController@index","route_name":["admin.features.textToSpeech.lists", "admin.features.textToSpeech.view"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 143,
                'sort' => 11,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
        ], 'id');
    }
}
