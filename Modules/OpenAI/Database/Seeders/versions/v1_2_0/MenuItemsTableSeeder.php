<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_2_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('menu_items')->insert([
            [
                'label' => 'speech',
                'link' => 'speech/list',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\SpeechController@index","route_name":["admin.features.speeches", "admin.features.speech.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 143,
                'sort' => 12,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
        ]);

    }
}
