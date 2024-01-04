<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UseCaseUseCaseCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('use_case_use_case_category')->delete();

        \DB::table('use_case_use_case_category')->insert(array (
            0 => 
            array (
                'use_case_id' => 1,
                'use_case_category_id' => 2,
            ),
            1 => 
            array (
                'use_case_id' => 2,
                'use_case_category_id' => 2,
            ),
            2 => 
            array (
                'use_case_id' => 3,
                'use_case_category_id' => 2,
            ),
            3 => 
            array (
                'use_case_id' => 4,
                'use_case_category_id' => 1,
            ),
            4 => 
            array (
                'use_case_id' => 5,
                'use_case_category_id' => 1,
            ),
            5 => 
            array (
                'use_case_id' => 6,
                'use_case_category_id' => 1,
            ),
            6 => 
            array (
                'use_case_id' => 7,
                'use_case_category_id' => 1,
            ),
            7 => 
            array (
                'use_case_id' => 8,
                'use_case_category_id' => 1,
            ),
            8 => 
            array (
                'use_case_id' => 9,
                'use_case_category_id' => 1,
            ),
            9 => 
            array (
                'use_case_id' => 10,
                'use_case_category_id' => 8,
            ),
            10 => 
            array (
                'use_case_id' => 11,
                'use_case_category_id' => 3,
            ),
            11 => 
            array (
                'use_case_id' => 12,
                'use_case_category_id' => 3,
            ),
            12 => 
            array (
                'use_case_id' => 13,
                'use_case_category_id' => 3,
            ),
            13 => 
            array (
                'use_case_id' => 14,
                'use_case_category_id' => 7,
            ),
            14 => 
            array (
                'use_case_id' => 15,
                'use_case_category_id' => 7,
            ),
            15 => 
            array (
                'use_case_id' => 16,
                'use_case_category_id' => 4,
            ),
            16 => 
            array (
                'use_case_id' => 17,
                'use_case_category_id' => 4,
            ),
            17 => 
            array (
                'use_case_id' => 18,
                'use_case_category_id' => 4,
            ),
            18 => 
            array (
                'use_case_id' => 19,
                'use_case_category_id' => 4,
            ),
            19 => 
            array (
                'use_case_id' => 20,
                'use_case_category_id' => 4,
            ),
            20 => 
            array (
                'use_case_id' => 21,
                'use_case_category_id' => 4,
            ),
            21 => 
            array (
                'use_case_id' => 22,
                'use_case_category_id' => 4,
            ),
            22 => 
            array (
                'use_case_id' => 23,
                'use_case_category_id' => 4,
            ),
            23 => 
            array (
                'use_case_id' => 24,
                'use_case_category_id' => 5,
            ),
            24 => 
            array (
                'use_case_id' => 25,
                'use_case_category_id' => 5,
            ),
            25 => 
            array (
                'use_case_id' => 26,
                'use_case_category_id' => 5,
            ),
            26 => 
            array (
                'use_case_id' => 27,
                'use_case_category_id' => 5,
            ),
            27 => 
            array (
                'use_case_id' => 28,
                'use_case_category_id' => 5,
            ),
            28 => 
            array (
                'use_case_id' => 29,
                'use_case_category_id' => 6,
            ),
            29 => 
            array (
                'use_case_id' => 30,
                'use_case_category_id' => 6,
            ),
            30 => 
            array (
                'use_case_id' => 31,
                'use_case_category_id' => 6,
            ),
            31 => 
            array (
                'use_case_id' => 32,
                'use_case_category_id' => 6,
            ),
            32 => 
            array (
                'use_case_id' => 33,
                'use_case_category_id' => 6,
            ),
            33 => 
            array (
                'use_case_id' => 34,
                'use_case_category_id' => 6,
            ),
            34 => 
            array (
                'use_case_id' => 35,
                'use_case_category_id' => 6,
            ),
            35 => 
            array (
                'use_case_id' => 36,
                'use_case_category_id' => 6,
            ),
            36 => 
            array (
                'use_case_id' => 37,
                'use_case_category_id' => 6,
            ),
            37 => 
            array (
                'use_case_id' => 38,
                'use_case_category_id' => 6,
            ),
        ));

    }
}
