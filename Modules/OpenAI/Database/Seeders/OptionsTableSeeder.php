<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('options')->delete();
        
        \DB::table('options')->insert(array (
            0 => 
            array (
                'id' => 1,
                'use_case_id' => 25,
                'type' => 'textarea',
                'key' => 'job_description',
            ),
            1 => 
            array (
                'id' => 2,
                'use_case_id' => 25,
                'type' => 'text',
                'key' => 'experience',
            ),
            2 => 
            array (
                'id' => 3,
                'use_case_id' => 2,
                'type' => 'text',
                'key' => 'title',
            ),
            3 => 
            array (
                'id' => 4,
                'use_case_id' => 2,
                'type' => 'text',
                'key' => 'topic',
            ),
            4 => 
            array (
                'id' => 5,
                'use_case_id' => 3,
                'type' => 'textarea',
                'key' => 'story',
            ),
            5 => 
            array (
                'id' => 8,
                'use_case_id' => 1,
                'type' => 'text',
                'key' => 'blog_idea',
            ),
            6 => 
            array (
                'id' => 9,
                'use_case_id' => 4,
                'type' => 'text',
                'key' => 'google_ad',
            ),
            7 => 
            array (
                'id' => 10,
                'use_case_id' => 5,
                'type' => 'text',
                'key' => 'facebook_ad',
            ),
            8 => 
            array (
                'id' => 11,
                'use_case_id' => 6,
                'type' => 'text',
                'key' => 'keyword_generator',
            ),
            9 => 
            array (
                'id' => 12,
                'use_case_id' => 8,
                'type' => 'text',
                'key' => 'seo_meta',
            ),
            10 => 
            array (
                'id' => 13,
                'use_case_id' => 7,
                'type' => 'text',
                'key' => 'keyword_extractor',
            ),
            11 => 
            array (
                'id' => 14,
                'use_case_id' => 9,
                'type' => 'text',
                'key' => 'marketing_stratigy',
            ),
            12 => 
            array (
                'id' => 15,
                'use_case_id' => 10,
                'type' => 'text',
                'key' => 'page',
            ),
            13 => 
            array (
                'id' => 16,
                'use_case_id' => 10,
                'type' => 'text',
                'key' => 'audience',
            ),
            14 => 
            array (
                'id' => 17,
                'use_case_id' => 11,
                'type' => 'text',
                'key' => 'product_name',
            ),
            15 => 
            array (
                'id' => 18,
                'use_case_id' => 11,
                'type' => 'text',
                'key' => 'keyword',
            ),
            16 => 
            array (
                'id' => 19,
                'use_case_id' => 12,
                'type' => 'text',
                'key' => 'product_name',
            ),
            17 => 
            array (
                'id' => 20,
                'use_case_id' => 12,
                'type' => 'text',
                'key' => 'audience',
            ),
            18 => 
            array (
                'id' => 21,
                'use_case_id' => 12,
                'type' => 'textarea',
                'key' => 'description',
            ),
            19 => 
            array (
                'id' => 22,
                'use_case_id' => 13,
                'type' => 'text',
                'key' => 'product_name',
            ),
            20 => 
            array (
                'id' => 23,
                'use_case_id' => 13,
                'type' => 'textarea',
                'key' => 'product_description',
            ),
            21 => 
            array (
                'id' => 24,
                'use_case_id' => 14,
                'type' => 'text',
                'key' => 'profession',
            ),
            22 => 
            array (
                'id' => 25,
                'use_case_id' => 14,
                'type' => 'textarea',
                'key' => 'skils',
            ),
            23 => 
            array (
                'id' => 26,
                'use_case_id' => 14,
                'type' => 'text',
                'key' => 'experience',
            ),
            24 => 
            array (
                'id' => 27,
                'use_case_id' => 15,
                'type' => 'text',
                'key' => 'experience',
            ),
            25 => 
            array (
                'id' => 28,
                'use_case_id' => 15,
                'type' => 'textarea',
                'key' => 'skils',
            ),
            26 => 
            array (
                'id' => 29,
                'use_case_id' => 15,
                'type' => 'text',
                'key' => 'education',
            ),
            27 => 
            array (
                'id' => 31,
                'use_case_id' => 16,
                'type' => 'text',
                'key' => 'title',
            ),
            28 => 
            array (
                'id' => 32,
                'use_case_id' => 16,
                'type' => 'text',
                'key' => 'content',
            ),
            29 => 
            array (
                'id' => 33,
                'use_case_id' => 17,
                'type' => 'text',
                'key' => 'content',
            ),
            30 => 
            array (
                'id' => 34,
                'use_case_id' => 18,
                'type' => 'text',
                'key' => 'business_idea',
            ),
            31 => 
            array (
                'id' => 35,
                'use_case_id' => 18,
                'type' => 'text',
                'key' => 'keyword',
            ),
            32 => 
            array (
                'id' => 36,
                'use_case_id' => 19,
                'type' => 'text',
                'key' => 'brand_name',
            ),
            33 => 
            array (
                'id' => 37,
                'use_case_id' => 19,
                'type' => 'text',
                'key' => 'audience',
            ),
            34 => 
            array (
                'id' => 38,
                'use_case_id' => 20,
                'type' => 'text',
                'key' => 'headline',
            ),
            35 => 
            array (
                'id' => 39,
                'use_case_id' => 21,
                'type' => 'textarea',
                'key' => 'improve',
            ),
            36 => 
            array (
                'id' => 40,
                'use_case_id' => 22,
                'type' => 'textarea',
                'key' => 'rephrase',
            ),
            37 => 
            array (
                'id' => 41,
                'use_case_id' => 23,
                'type' => 'textarea',
                'key' => 'summarize',
            ),
            38 => 
            array (
                'id' => 42,
                'use_case_id' => 24,
                'type' => 'text',
                'key' => 'cover_letter',
            ),
            39 => 
            array (
                'id' => 43,
                'use_case_id' => 24,
                'type' => 'text',
                'key' => 'skill',
            ),
            40 => 
            array (
                'id' => 44,
                'use_case_id' => 26,
                'type' => 'text',
                'key' => 'company_name',
            ),
            41 => 
            array (
                'id' => 45,
                'use_case_id' => 26,
                'type' => 'text',
                'key' => 'company_task',
            ),
            42 => 
            array (
                'id' => 46,
                'use_case_id' => 27,
                'type' => 'text',
                'key' => 'question_answer',
            ),
            43 => 
            array (
                'id' => 47,
                'use_case_id' => 28,
                'type' => 'text',
                'key' => 'interview_question',
            ),
            44 => 
            array (
                'id' => 48,
                'use_case_id' => 28,
                'type' => 'textarea',
                'key' => 'interview_question_content',
            ),
            45 => 
            array (
                'id' => 49,
                'use_case_id' => 29,
                'type' => 'text',
                'key' => 'aida_content',
            ),
            46 => 
            array (
                'id' => 50,
                'use_case_id' => 30,
                'type' => 'text',
                'key' => 'pas_content',
            ),
            47 => 
            array (
                'id' => 51,
                'use_case_id' => 31,
                'type' => 'textarea',
                'key' => 'child_content',
            ),
            48 => 
            array (
                'id' => 52,
                'use_case_id' => 32,
                'type' => 'text',
                'key' => 'notification',
            ),
            49 => 
            array (
                'id' => 53,
                'use_case_id' => 32,
                'type' => 'text',
                'key' => 'notification_content',
            ),
            50 => 
            array (
                'id' => 54,
                'use_case_id' => 33,
                'type' => 'text',
                'key' => 'tweet',
            ),
            51 => 
            array (
                'id' => 55,
                'use_case_id' => 34,
                'type' => 'text',
                'key' => 'video_title',
            ),
            52 => 
            array (
                'id' => 56,
                'use_case_id' => 34,
                'type' => 'text',
                'key' => 'video_content',
            ),
            53 => 
            array (
                'id' => 57,
                'use_case_id' => 35,
                'type' => 'text',
                'key' => 'youtube_video_title',
            ),
            54 => 
            array (
                'id' => 58,
                'use_case_id' => 35,
                'type' => 'text',
                'key' => 'youtube_video_content',
            ),
            55 => 
            array (
                'id' => 59,
                'use_case_id' => 36,
                'type' => 'text',
                'key' => 'youtube_video_idea',
            ),
            56 => 
            array (
                'id' => 60,
                'use_case_id' => 37,
                'type' => 'text',
                'key' => 'poetry',
            ),
            57 => 
            array (
                'id' => 61,
                'use_case_id' => 38,
                'type' => 'textarea',
                'key' => 'question',
            ),
        ));
        
        
    }
}