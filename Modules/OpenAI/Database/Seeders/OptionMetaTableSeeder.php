<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;

class OptionMetaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('option_meta')->delete();
        
        \DB::table('option_meta')->insert(array (
            0 => 
            array (
                'id' => 2,
                'option_id' => 2,
                'key' => 'required',
                'value' => 'required',
            ),
            1 => 
            array (
                'id' => 3,
                'option_id' => 2,
                'key' => 'label',
                'value' => 'Year of experience',
            ),
            2 => 
            array (
                'id' => 4,
                'option_id' => 2,
                'key' => 'placeholder',
                'value' => 'Year of experience',
            ),
            3 => 
            array (
                'id' => 6,
                'option_id' => 1,
                'key' => 'required',
                'value' => 'required',
            ),
            4 => 
            array (
                'id' => 7,
                'option_id' => 1,
                'key' => 'label',
                'value' => 'Job Post',
            ),
            5 => 
            array (
                'id' => 8,
                'option_id' => 1,
                'key' => 'placeholder',
                'value' => 'Job Post',
            ),
            6 => 
            array (
                'id' => 9,
                'option_id' => 3,
                'key' => 'required',
                'value' => 'required',
            ),
            7 => 
            array (
                'id' => 10,
                'option_id' => 3,
                'key' => 'label',
                'value' => 'Title of your blog article',
            ),
            8 => 
            array (
                'id' => 11,
                'option_id' => 3,
                'key' => 'placeholder',
                'value' => 'Article about the smartphone',
            ),
            9 => 
            array (
                'id' => 12,
                'option_id' => 4,
                'key' => 'required',
                'value' => 'required',
            ),
            10 => 
            array (
                'id' => 13,
                'option_id' => 4,
                'key' => 'label',
                'value' => 'Keyword or content of your blog',
            ),
            11 => 
            array (
                'id' => 14,
                'option_id' => 4,
                'key' => 'placeholder',
                'value' => 'Story about a horror night, first day at school',
            ),
            12 => 
            array (
                'id' => 15,
                'option_id' => 5,
                'key' => 'required',
                'value' => 'required',
            ),
            13 => 
            array (
                'id' => 16,
                'option_id' => 5,
                'key' => 'label',
                'value' => 'Story About',
            ),
            14 => 
            array (
                'id' => 17,
                'option_id' => 5,
                'key' => 'placeholder',
                'value' => 'Story about a horror night, first day at school',
            ),
            15 => 
            array (
                'id' => 24,
                'option_id' => 8,
                'key' => 'required',
                'value' => 'required',
            ),
            16 => 
            array (
                'id' => 25,
                'option_id' => 8,
                'key' => 'label',
                'value' => 'Blog Idea and outline about',
            ),
            17 => 
            array (
                'id' => 26,
                'option_id' => 8,
                'key' => 'placeholder',
                'value' => 'Travel, Technology',
            ),
            18 => 
            array (
                'id' => 27,
                'option_id' => 9,
                'key' => 'placeholder',
                'value' => 'Mobile, Technology',
            ),
            19 => 
            array (
                'id' => 28,
                'option_id' => 9,
                'key' => 'label',
                'value' => 'Google add about',
            ),
            20 => 
            array (
                'id' => 29,
                'option_id' => 9,
                'key' => 'required',
                'value' => 'required',
            ),
            21 => 
            array (
                'id' => 30,
                'option_id' => 10,
                'key' => 'required',
                'value' => 'required',
            ),
            22 => 
            array (
                'id' => 31,
                'option_id' => 10,
                'key' => 'label',
                'value' => 'Facebook add about',
            ),
            23 => 
            array (
                'id' => 32,
                'option_id' => 10,
                'key' => 'placeholder',
                'value' => 'Mobile, Technology',
            ),
            24 => 
            array (
                'id' => 33,
                'option_id' => 11,
                'key' => 'placeholder',
                'value' => 'Shop name, Business name',
            ),
            25 => 
            array (
                'id' => 34,
                'option_id' => 11,
                'key' => 'label',
                'value' => 'Keyword about',
            ),
            26 => 
            array (
                'id' => 35,
                'option_id' => 11,
                'key' => 'required',
                'value' => 'required',
            ),
            27 => 
            array (
                'id' => 36,
                'option_id' => 12,
                'key' => 'required',
                'value' => 'required',
            ),
            28 => 
            array (
                'id' => 37,
                'option_id' => 12,
                'key' => 'label',
                'value' => 'SEO meta title about',
            ),
            29 => 
            array (
                'id' => 38,
                'option_id' => 12,
                'key' => 'placeholder',
                'value' => 'Mobile, TV',
            ),
            30 => 
            array (
                'id' => 39,
                'option_id' => 13,
                'key' => 'required',
                'value' => 'required',
            ),
            31 => 
            array (
                'id' => 40,
                'option_id' => 13,
                'key' => 'label',
                'value' => 'Content Extractor From Text',
            ),
            32 => 
            array (
                'id' => 41,
                'option_id' => 13,
                'key' => 'placeholder',
                'value' => 'Text content where you find the keyword',
            ),
            33 => 
            array (
                'id' => 42,
                'option_id' => 14,
                'key' => 'required',
                'value' => 'required',
            ),
            34 => 
            array (
                'id' => 43,
                'option_id' => 14,
                'key' => 'label',
                'value' => 'Marketing and Strategies about',
            ),
            35 => 
            array (
                'id' => 44,
                'option_id' => 14,
                'key' => 'placeholder',
                'value' => 'Marketing and Strategies about Electronic item',
            ),
            36 => 
            array (
                'id' => 45,
                'option_id' => 16,
                'key' => 'placeholder',
                'value' => 'Landing page about smartwatch, health care',
            ),
            37 => 
            array (
                'id' => 46,
                'option_id' => 16,
                'key' => 'label',
                'value' => 'landing page about',
            ),
            38 => 
            array (
                'id' => 47,
                'option_id' => 16,
                'key' => 'required',
                'value' => 'required',
            ),
            39 => 
            array (
                'id' => 48,
                'option_id' => 15,
                'key' => 'required',
                'value' => 'required',
            ),
            40 => 
            array (
                'id' => 49,
                'option_id' => 15,
                'key' => 'label',
                'value' => 'Targeted Audience',
            ),
            41 => 
            array (
                'id' => 50,
                'option_id' => 15,
                'key' => 'placeholder',
                'value' => 'Targeted audience is old generation',
            ),
            42 => 
            array (
                'id' => 51,
                'option_id' => 17,
                'key' => 'placeholder',
                'value' => 'Best laptop in your budget',
            ),
            43 => 
            array (
                'id' => 52,
                'option_id' => 17,
                'key' => 'label',
                'value' => 'Product Name',
            ),
            44 => 
            array (
                'id' => 53,
                'option_id' => 17,
                'key' => 'required',
                'value' => 'required',
            ),
            45 => 
            array (
                'id' => 54,
                'option_id' => 18,
                'key' => 'required',
                'value' => 'required',
            ),
            46 => 
            array (
                'id' => 55,
                'option_id' => 18,
                'key' => 'label',
                'value' => 'Keyword',
            ),
            47 => 
            array (
                'id' => 56,
                'option_id' => 18,
                'key' => 'placeholder',
                'value' => 'Best laptop, Mobile',
            ),
            48 => 
            array (
                'id' => 57,
                'option_id' => 19,
                'key' => 'placeholder',
                'value' => 'Electronics, laptop, Mobile',
            ),
            49 => 
            array (
                'id' => 58,
                'option_id' => 19,
                'key' => 'label',
                'value' => 'Product Name',
            ),
            50 => 
            array (
                'id' => 59,
                'option_id' => 19,
                'key' => 'required',
                'value' => 'required',
            ),
            51 => 
            array (
                'id' => 60,
                'option_id' => 20,
                'key' => 'required',
                'value' => 'required',
            ),
            52 => 
            array (
                'id' => 61,
                'option_id' => 20,
                'key' => 'label',
                'value' => 'Target Audience ',
            ),
            53 => 
            array (
                'id' => 62,
                'option_id' => 20,
                'key' => 'placeholder',
                'value' => 'Women, Girl',
            ),
            54 => 
            array (
                'id' => 63,
                'option_id' => 21,
                'key' => 'placeholder',
                'value' => 'Smart phone that can use for daily life and make life easier.',
            ),
            55 => 
            array (
                'id' => 64,
                'option_id' => 21,
                'key' => 'label',
                'value' => 'Product Description',
            ),
            56 => 
            array (
                'id' => 65,
                'option_id' => 21,
                'key' => 'required',
                'value' => 'required',
            ),
            57 => 
            array (
                'id' => 66,
                'option_id' => 22,
                'key' => 'required',
                'value' => 'required',
            ),
            58 => 
            array (
                'id' => 67,
                'option_id' => 22,
                'key' => 'label',
                'value' => 'Product Name',
            ),
            59 => 
            array (
                'id' => 68,
                'option_id' => 22,
                'key' => 'placeholder',
                'value' => 'Water Bottle',
            ),
            60 => 
            array (
                'id' => 69,
                'option_id' => 23,
                'key' => 'placeholder',
                'value' => 'Quality of this bottle is so good and easy to use ',
            ),
            61 => 
            array (
                'id' => 70,
                'option_id' => 23,
                'key' => 'label',
                'value' => 'Product Description',
            ),
            62 => 
            array (
                'id' => 71,
                'option_id' => 23,
                'key' => 'required',
                'value' => 'required',
            ),
            63 => 
            array (
                'id' => 72,
                'option_id' => 24,
                'key' => 'required',
                'value' => 'required',
            ),
            64 => 
            array (
                'id' => 73,
                'option_id' => 24,
                'key' => 'label',
                'value' => 'Profession',
            ),
            65 => 
            array (
                'id' => 74,
                'option_id' => 24,
                'key' => 'placeholder',
                'value' => 'Network engineer, Web developer',
            ),
            66 => 
            array (
                'id' => 75,
                'option_id' => 25,
                'key' => 'placeholder',
                'value' => 'PHP, Laravel',
            ),
            67 => 
            array (
                'id' => 76,
                'option_id' => 25,
                'key' => 'label',
                'value' => 'Skills ',
            ),
            68 => 
            array (
                'id' => 77,
                'option_id' => 25,
                'key' => 'required',
                'value' => 'required',
            ),
            69 => 
            array (
                'id' => 78,
                'option_id' => 26,
                'key' => 'required',
                'value' => 'required',
            ),
            70 => 
            array (
                'id' => 79,
                'option_id' => 26,
                'key' => 'label',
                'value' => 'Experinece',
            ),
            71 => 
            array (
                'id' => 80,
                'option_id' => 26,
                'key' => 'placeholder',
                'value' => '2 / 3',
            ),
            72 => 
            array (
                'id' => 81,
                'option_id' => 27,
                'key' => 'placeholder',
                'value' => '2 / 3',
            ),
            73 => 
            array (
                'id' => 82,
                'option_id' => 27,
                'key' => 'label',
                'value' => 'Experinece',
            ),
            74 => 
            array (
                'id' => 83,
                'option_id' => 27,
                'key' => 'required',
                'value' => 'required',
            ),
            75 => 
            array (
                'id' => 84,
                'option_id' => 28,
                'key' => 'required',
                'value' => 'required',
            ),
            76 => 
            array (
                'id' => 85,
                'option_id' => 28,
                'key' => 'label',
                'value' => 'Skills ',
            ),
            77 => 
            array (
                'id' => 86,
                'option_id' => 28,
                'key' => 'placeholder',
                'value' => 'PHP, Laravel',
            ),
            78 => 
            array (
                'id' => 87,
                'option_id' => 29,
                'key' => 'placeholder',
                'value' => 'Bsc in Computer science',
            ),
            79 => 
            array (
                'id' => 88,
                'option_id' => 29,
                'key' => 'label',
                'value' => 'Education',
            ),
            80 => 
            array (
                'id' => 89,
                'option_id' => 29,
                'key' => 'required',
                'value' => 'required',
            ),
            81 => 
            array (
                'id' => 90,
                'option_id' => 31,
                'key' => 'required',
                'value' => 'required',
            ),
            82 => 
            array (
                'id' => 91,
                'option_id' => 31,
                'key' => 'label',
                'value' => 'Mail Title',
            ),
            83 => 
            array (
                'id' => 92,
                'option_id' => 31,
                'key' => 'placeholder',
                'value' => 'Marketing about shirt',
            ),
            84 => 
            array (
                'id' => 93,
                'option_id' => 32,
                'key' => 'placeholder',
                'value' => 'Best fabric, Quality sewing',
            ),
            85 => 
            array (
                'id' => 94,
                'option_id' => 32,
                'key' => 'label',
                'value' => 'Content',
            ),
            86 => 
            array (
                'id' => 95,
                'option_id' => 32,
                'key' => 'required',
                'value' => 'required',
            ),
            87 => 
            array (
                'id' => 96,
                'option_id' => 33,
                'key' => 'required',
                'value' => 'required',
            ),
            88 => 
            array (
                'id' => 97,
                'option_id' => 33,
                'key' => 'label',
                'value' => 'Call to action about',
            ),
            89 => 
            array (
                'id' => 98,
                'option_id' => 33,
                'key' => 'placeholder',
                'value' => 'Joining at office',
            ),
            90 => 
            array (
                'id' => 99,
                'option_id' => 34,
                'key' => 'placeholder',
                'value' => 'about garments, fabrics',
            ),
            91 => 
            array (
                'id' => 100,
                'option_id' => 34,
                'key' => 'label',
                'value' => 'Business Idea About',
            ),
            92 => 
            array (
                'id' => 101,
                'option_id' => 34,
                'key' => 'required',
                'value' => 'required',
            ),
            93 => 
            array (
                'id' => 102,
                'option_id' => 35,
                'key' => 'required',
                'value' => 'required',
            ),
            94 => 
            array (
                'id' => 103,
                'option_id' => 35,
                'key' => 'label',
                'value' => 'Content',
            ),
            95 => 
            array (
                'id' => 104,
                'option_id' => 35,
                'key' => 'placeholder',
                'value' => 'Soft Cotton, Fabric ',
            ),
            96 => 
            array (
                'id' => 105,
                'option_id' => 36,
                'key' => 'placeholder',
                'value' => 'Megasoft',
            ),
            97 => 
            array (
                'id' => 106,
                'option_id' => 36,
                'key' => 'label',
                'value' => 'Name',
            ),
            98 => 
            array (
                'id' => 107,
                'option_id' => 36,
                'key' => 'required',
                'value' => 'required',
            ),
            99 => 
            array (
                'id' => 108,
                'option_id' => 37,
                'key' => 'required',
                'value' => 'required',
            ),
            100 => 
            array (
                'id' => 109,
                'option_id' => 37,
                'key' => 'label',
                'value' => 'Target Audience',
            ),
            101 => 
            array (
                'id' => 110,
                'option_id' => 37,
                'key' => 'placeholder',
                'value' => 'Young generation',
            ),
            102 => 
            array (
                'id' => 111,
                'option_id' => 38,
                'key' => 'placeholder',
                'value' => 'Breaking news',
            ),
            103 => 
            array (
                'id' => 112,
                'option_id' => 38,
                'key' => 'label',
                'value' => 'Headline About',
            ),
            104 => 
            array (
                'id' => 113,
                'option_id' => 38,
                'key' => 'required',
                'value' => 'required',
            ),
            105 => 
            array (
                'id' => 114,
                'option_id' => 39,
                'key' => 'required',
                'value' => 'required',
            ),
            106 => 
            array (
                'id' => 115,
                'option_id' => 39,
                'key' => 'label',
                'value' => 'Content Improvement',
            ),
            107 => 
            array (
                'id' => 116,
                'option_id' => 39,
                'key' => 'placeholder',
                'value' => 'write content and get the improve version of it.',
            ),
            108 => 
            array (
                'id' => 117,
                'option_id' => 40,
                'key' => 'placeholder',
                'value' => 'write content and get the improve version of it.',
            ),
            109 => 
            array (
                'id' => 118,
                'option_id' => 40,
                'key' => 'label',
                'value' => 'Content Rephrase',
            ),
            110 => 
            array (
                'id' => 119,
                'option_id' => 40,
                'key' => 'required',
                'value' => 'required',
            ),
            111 => 
            array (
                'id' => 120,
                'option_id' => 41,
                'key' => 'required',
                'value' => 'required',
            ),
            112 => 
            array (
                'id' => 121,
                'option_id' => 41,
                'key' => 'label',
                'value' => 'Content Summarize',
            ),
            113 => 
            array (
                'id' => 122,
                'option_id' => 41,
                'key' => 'placeholder',
                'value' => 'write content and get the summary of it.',
            ),
            114 => 
            array (
                'id' => 123,
                'option_id' => 42,
                'key' => 'placeholder',
                'value' => 'Junior Develoepr',
            ),
            115 => 
            array (
                'id' => 124,
                'option_id' => 42,
                'key' => 'label',
                'value' => 'Cover letter for',
            ),
            116 => 
            array (
                'id' => 125,
                'option_id' => 42,
                'key' => 'required',
                'value' => 'required',
            ),
            117 => 
            array (
                'id' => 126,
                'option_id' => 43,
                'key' => 'required',
                'value' => 'required',
            ),
            118 => 
            array (
                'id' => 127,
                'option_id' => 43,
                'key' => 'label',
                'value' => 'Experties in',
            ),
            119 => 
            array (
                'id' => 128,
                'option_id' => 43,
                'key' => 'placeholder',
                'value' => 'PHP, MySQL, Ajax',
            ),
            120 => 
            array (
                'id' => 129,
                'option_id' => 44,
                'key' => 'placeholder',
                'value' => 'ABC Company',
            ),
            121 => 
            array (
                'id' => 130,
                'option_id' => 44,
                'key' => 'label',
                'value' => 'Company Name',
            ),
            122 => 
            array (
                'id' => 131,
                'option_id' => 44,
                'key' => 'required',
                'value' => 'required',
            ),
            123 => 
            array (
                'id' => 132,
                'option_id' => 45,
                'key' => 'required',
                'value' => 'required',
            ),
            124 => 
            array (
                'id' => 133,
                'option_id' => 45,
                'key' => 'label',
                'value' => 'Company Works With',
            ),
            125 => 
            array (
                'id' => 134,
                'option_id' => 45,
                'key' => 'placeholder',
                'value' => 'AI, Development, Technology',
            ),
            126 => 
            array (
                'id' => 135,
                'option_id' => 46,
                'key' => 'placeholder',
                'value' => 'about AI, Web Development, Technology',
            ),
            127 => 
            array (
                'id' => 136,
                'option_id' => 46,
                'key' => 'label',
                'value' => 'Question And Answer About',
            ),
            128 => 
            array (
                'id' => 137,
                'option_id' => 46,
                'key' => 'required',
                'value' => 'required',
            ),
            129 => 
            array (
                'id' => 138,
                'option_id' => 47,
                'key' => 'required',
                'value' => 'required',
            ),
            130 => 
            array (
                'id' => 139,
                'option_id' => 47,
                'key' => 'label',
                'value' => 'Interview Question About',
            ),
            131 => 
            array (
                'id' => 140,
                'option_id' => 47,
                'key' => 'placeholder',
                'value' => 'about AI, Web Development, Technology',
            ),
            132 => 
            array (
                'id' => 141,
                'option_id' => 48,
                'key' => 'placeholder',
                'value' => 'Technology, General Knowledge',
            ),
            133 => 
            array (
                'id' => 142,
                'option_id' => 48,
                'key' => 'label',
                'value' => 'Interview Question Content',
            ),
            134 => 
            array (
                'id' => 143,
                'option_id' => 48,
                'key' => 'required',
                'value' => 'required',
            ),
            135 => 
            array (
                'id' => 144,
                'option_id' => 49,
                'key' => 'required',
                'value' => 'required',
            ),
            136 => 
            array (
                'id' => 145,
                'option_id' => 49,
                'key' => 'label',
                'value' => 'AIDA Model about',
            ),
            137 => 
            array (
                'id' => 146,
                'option_id' => 49,
                'key' => 'placeholder',
                'value' => 'Technology, General Knowledge',
            ),
            138 => 
            array (
                'id' => 147,
                'option_id' => 50,
                'key' => 'placeholder',
                'value' => 'Technology, General Knowledge',
            ),
            139 => 
            array (
                'id' => 148,
                'option_id' => 50,
                'key' => 'label',
                'value' => 'PAS Model About',
            ),
            140 => 
            array (
                'id' => 149,
                'option_id' => 50,
                'key' => 'required',
                'value' => 'required',
            ),
            141 => 
            array (
                'id' => 150,
                'option_id' => 51,
                'key' => 'required',
                'value' => 'required',
            ),
            142 => 
            array (
                'id' => 151,
                'option_id' => 51,
                'key' => 'label',
                'value' => 'Content For Child',
            ),
            143 => 
            array (
                'id' => 152,
                'option_id' => 51,
                'key' => 'placeholder',
                'value' => 'Write teh content that you want to lower grade context for child.',
            ),
            144 => 
            array (
                'id' => 153,
                'option_id' => 52,
                'key' => 'placeholder',
                'value' => 'Notification for discount',
            ),
            145 => 
            array (
                'id' => 154,
                'option_id' => 52,
                'key' => 'label',
                'value' => 'Notification For',
            ),
            146 => 
            array (
                'id' => 155,
                'option_id' => 52,
                'key' => 'required',
                'value' => 'required',
            ),
            147 => 
            array (
                'id' => 156,
                'option_id' => 53,
                'key' => 'required',
                'value' => 'required',
            ),
            148 => 
            array (
                'id' => 157,
                'option_id' => 53,
                'key' => 'label',
                'value' => 'Notification Content',
            ),
            149 => 
            array (
                'id' => 158,
                'option_id' => 53,
                'key' => 'placeholder',
                'value' => 'Discount, Offer ',
            ),
            150 => 
            array (
                'id' => 159,
                'option_id' => 54,
                'key' => 'placeholder',
                'value' => 'Tweet about your activity',
            ),
            151 => 
            array (
                'id' => 160,
                'option_id' => 54,
                'key' => 'label',
                'value' => 'Tweet For',
            ),
            152 => 
            array (
                'id' => 161,
                'option_id' => 54,
                'key' => 'required',
                'value' => 'required',
            ),
            153 => 
            array (
                'id' => 162,
                'option_id' => 55,
                'key' => 'required',
                'value' => 'required',
            ),
            154 => 
            array (
                'id' => 163,
                'option_id' => 55,
                'key' => 'label',
                'value' => 'Video Title',
            ),
            155 => 
            array (
                'id' => 164,
                'option_id' => 55,
                'key' => 'placeholder',
                'value' => 'New Vlog with My New Bike ',
            ),
            156 => 
            array (
                'id' => 165,
                'option_id' => 56,
                'key' => 'placeholder',
                'value' => 'Bike tour, New place',
            ),
            157 => 
            array (
                'id' => 166,
                'option_id' => 56,
                'key' => 'label',
                'value' => 'Video Content',
            ),
            158 => 
            array (
                'id' => 167,
                'option_id' => 56,
                'key' => 'required',
                'value' => 'required',
            ),
            159 => 
            array (
                'id' => 168,
                'option_id' => 57,
                'key' => 'required',
                'value' => 'required',
            ),
            160 => 
            array (
                'id' => 169,
                'option_id' => 57,
                'key' => 'label',
                'value' => 'Youtube Video Title',
            ),
            161 => 
            array (
                'id' => 170,
                'option_id' => 57,
                'key' => 'placeholder',
                'value' => 'Bike tour, New place',
            ),
            162 => 
            array (
                'id' => 171,
                'option_id' => 58,
                'key' => 'placeholder',
                'value' => 'Bike tour, New place',
            ),
            163 => 
            array (
                'id' => 172,
                'option_id' => 58,
                'key' => 'label',
                'value' => 'Youtube Video Description',
            ),
            164 => 
            array (
                'id' => 173,
                'option_id' => 58,
                'key' => 'required',
                'value' => 'required',
            ),
            165 => 
            array (
                'id' => 174,
                'option_id' => 59,
                'key' => 'required',
                'value' => 'required',
            ),
            166 => 
            array (
                'id' => 175,
                'option_id' => 59,
                'key' => 'label',
                'value' => 'Youtube Video Ideas',
            ),
            167 => 
            array (
                'id' => 176,
                'option_id' => 59,
                'key' => 'placeholder',
                'value' => 'Vlog, Technology',
            ),
            168 => 
            array (
                'id' => 177,
                'option_id' => 60,
                'key' => 'placeholder',
                'value' => 'nature and its beauty',
            ),
            169 => 
            array (
                'id' => 178,
                'option_id' => 60,
                'key' => 'label',
                'value' => 'Poetry About',
            ),
            170 => 
            array (
                'id' => 179,
                'option_id' => 60,
                'key' => 'required',
                'value' => 'required',
            ),
            171 => 
            array (
                'id' => 180,
                'option_id' => 61,
                'key' => 'required',
                'value' => 'required',
            ),
            172 => 
            array (
                'id' => 181,
                'option_id' => 61,
                'key' => 'label',
                'value' => 'Question About',
            ),
            173 => 
            array (
                'id' => 182,
                'option_id' => 61,
                'key' => 'placeholder',
                'value' => 'Why the sky is blue?',
            ),
        ));
        
        
    }
}