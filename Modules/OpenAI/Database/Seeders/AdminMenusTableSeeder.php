<?php

namespace Modules\OpenAI\Database\Seeders;

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
                'id' => 141,
                'name' => 'All Templates',
                'slug' => 'openai-use-cases',
                'url' => 'use-cases',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\UseCasesController@index","route_name":["admin.use_case.list"],"menu_level":"1"}',
                'is_default' => 1
            ],
            [
                'id' => 142,
                'name' => 'All Template Categories',
                'slug' => 'openai-use-case-categories',
                'url' => 'use-case/categories',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\UseCaseCategoriesController@index","route_name":["admin.use_case.category.list"],"menu_level":"1"}',
                'is_default' => 1
            ],
            [
                'id' => 151,
                'name' => 'All Image',
                'slug' => 'image',
                'url' => 'image/list',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\ImageController@index","route_name":["admin.features.imageList"],"menu_level":"1"}',
                'is_default' => 1
            ],
            [
                'id' => 150,
                'name' => 'All Content',
                'slug' => 'content',
                'url' => 'content/list',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\OpenAIController@index","route_name":["admin.features.contents"],"menu_level":"1"}',
                'is_default' => 1
            ],
            [
                'id' => 166,
                'name' => 'All Code',
                'slug' => 'code',
                'url' => 'code/list',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\CodeController@index","route_name":["admin.features.code.list", "admin.features.code.view"],"menu_level":"1"}',
                'is_default' => 1
            ],
            [
                'id' => 170,
                'name' => 'AI Preferences',
                'slug' => 'openai-preferences',
                'url' => 'features/preferences',
                'permission' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\OpenAIController@contentPreferences", "route_name":["admin.features.preferences"], "menu_level":"1"}',
                'is_default' => 1,
            ],
        ], 'slug');

    }
}
