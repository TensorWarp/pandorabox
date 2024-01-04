<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('menu_items')->upsert([
            [
                'id' => 140,
                'label' => 'Use Case Templates',
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
            ],
            [
                'id' => 141,
                'label' => 'All Templates',
                'link' => 'use-cases',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\UseCasesController@index","route_name":["admin.use_case.create", "admin.use_case.list", "admin.use_case.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 140,
                'sort' => 1,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
            [
                'id' => 142,
                'label' => 'All Template Categories',
                'link' => 'use-case/categories',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\UseCaseCategoriesController@index","route_name":["admin.use_case.category.list", "admin.use_case.category.create", "admin.use_case.category.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 140,
                'sort' => 2,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
            [
                'id' => 143,
                'label' => 'AI Features',
                'link' => NULL,
                'params' => NULL,
                'is_default' => 0,
                'icon' => 'fab fa-asymmetrik',
                'parent' => 0,
                'sort' => 9,
                'class' => NULL,
                'menu' => 1,
                'depth' => 0,
                'is_custom_menu' => 1
            ],
            [
                'id' => 144,
                'label' => 'content',
                'link' => 'content/list',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\OpenAIController@index","route_name":["admin.features.contents", "admin.features.content.edit"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 143,
                'sort' => 9,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
            [
                'id' => 145,
                'label' => 'image',
                'link' => 'image/list',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\ImageController@images","route_name":["admin.features.imageList", "admin.features.image.view"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 143,
                'sort' => 10,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
            [
                'id' => 162,
                'label' => 'code',
                'link' => 'code/list',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\CodeController@images","route_name":["admin.features.code.list", "admin.features.code.view"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 143,
                'sort' => 11,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0
            ],
            [
                'id' => 163,
                'label' => 'AI Preferences',
                'link' => 'features/preferences',
                'params' => '{"permission":"Modules\\\\OpenAI\\\\Http\\\\Controllers\\\\Admin\\\\OpenAIController@contentPreferences","route_name":["admin.features.preferences"]}',
                'is_default' => 1,
                'icon' => NULL,
                'parent' => 31,
                'sort' => 50,
                'class' => NULL,
                'menu' => 1,
                'depth' => 1,
                'is_custom_menu' => 0,
            ],
        ], 'id');

    }
}
