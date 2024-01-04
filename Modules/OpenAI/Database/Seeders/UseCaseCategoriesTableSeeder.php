<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class UseCaseCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('use_case_categories')->delete();

        DB::table('use_case_categories')->insert([
            [
                'name' => 'Ads & Marketing Tools',
                'slug' => 'ads-marketing-tools',
                'description' => 'Ads & Marketing Tools Description',
            ],
            [
                'name' => 'Articles & Blogs',
                'slug' => 'articles-blogs',
                'description' => 'Articles & Blogs Description',
            ],
            [
                'name' => 'E-commerce',
                'slug' => 'e-commerce',
                'description' => 'E-commerce Description',
            ],
            [
                'name' => 'General Writing & Ideas',
                'slug' => 'general-writing-ideas',
                'description' => 'General Writing & Ideas Description',
            ],
            [
                'name' => 'Jobs & Companies',
                'slug' => 'jobs-companies',
                'description' => 'Jobs & Companies Description',
            ],
            [
                'name' => 'Miscellaneous',
                'slug' => 'miscellaneous',
                'description' => 'Miscellaneous Description',
            ],
            [
                'name' => 'Profile Enhancer',
                'slug' => 'profile-enhancer',
                'description' => 'Profile Enhancer Description',
            ],
            [
                'name' => 'Website',
                'slug' => 'website',
                'description' => 'Website Description',
            ],
            [
                'name' => 'Others',
                'slug' => 'others',
                'description' => 'Not having been sorted into a category.',
            ]
        ]);

    }
}
