<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('admin_menus')->upsert([
            [
                'name' => 'Voiceover',
                'slug' => 'voiceover',
                'url' => 'text-to-speech/list',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\TextToSpeechController@index","route_name":["admin.features.textToSpeech.lists", "admin.features.textToSpeech.view"],"menu_level":"1"}',
                'is_default' => 1
            ],
        ], 'slug');

    }
}
