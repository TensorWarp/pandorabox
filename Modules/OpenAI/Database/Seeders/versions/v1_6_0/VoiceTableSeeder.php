<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_6_0;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Mira Sol',
            'voice_name' => 'sv-SE-Standard-C',
            'language_code' => 'sv-SE',
            'gender' => 'Female',
            'file_name' => '20231207/473716ad42ef06bc4547351735a81032.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":22.6669921875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/e45728af80b03c137c0de6534cb19aa2.png',
            'file_size' => 22.67,
            'original_file_name' => 'photographed-using-sony-a9-ii-mirrorless-camera-by-photographer-photorealistic-a-20-years-old - 6799685.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Elias Storm',
            'voice_name' => 'sv-SE-Standard-E',
            'language_code' => 'sv-SE',
            'gender' => 'Male',
            'file_name' => '20231207/f9648bc3be6cd965a407e13ca9f92449.mp3',
            'status' => 'Active', 
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":32.6083984375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/a553199ca0497038bde8699e2f70a857.png',
            'file_size' => 32.61,
            'original_file_name' => 'good-looking-young-male-as-a-character-in-a-comedy-moviemovie-scene-funnya-highly-detailed-fa.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Linnea Frost',
            'voice_name' => 'sv-SE-Standard-B',
            'language_code' => 'sv-SE',
            'gender' => 'Female',
            'file_name' => '20231207/52195a810df5170c9ff5f9a7af7495ca.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":24.5302734375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/43bfb22d5132665241162a919fc51f47.png',
            'file_size' => 24.53,
            'original_file_name' => 'perfect-face-beautiful-swedish-army-woman-m90-camoflage-outfit-swedish-flag - brunette-hair-idea-436053226.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);
        
        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Viktor Moon',
            'voice_name' => 'sv-SE-Standard-D',
            'language_code' => 'sv-SE',
            'gender' => 'Male',
            'file_name' => '20231207/dab2dd44b49ecb909d97ef04f563a600.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
                'params' => '{"size":20.328125,"type":"png"}',
                'object_type' => 'png',
                'object_id' => NULL,
                'uploaded_by' => 1,
                'file_name' => '20231207/42f2bb5c2c7e027af88a446041c8df84.png',
                'file_size' => 20.33,
                'original_file_name' => 'portrait-real-photo-handsome-handsome-brutal-guy-30-years-old-brutal-short-blonde-hair-big-blue.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Amber Heath',
            'voice_name' => 'en-GB-Standard-C',
            'language_code' => 'en-GB',
            'gender' => 'Female',
            'file_name' => '20231207/e1c40a68d98e57e6fd0c318049347217.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":22.3720703125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/7ca04b3c119518227d9e6601acdda6f5.png',
            'file_size' => 22.37,
            'original_file_name' => 'a-beautiful-stunning-canadian-woman-with-perfect-amazing-eyes-standing-and-wearing-an-outfit-that-i-39970057.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Leo Finch',
            'voice_name' => 'en-GB-Standard-D',
            'language_code' => 'en-GB',
            'gender' => 'Male',
            'file_name' => '20231207/8d2e56a23faab9d02e52ce5e98a36e03.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":20.0849609375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/5916badf5d574cfd7d27fdab8ed0fc32.png',
            'file_size' => 20.08,
            'original_file_name' => 'cinematic-photo - photography-model-shot-man-with-beard-and-short-hair-employer-in-nuclear-war-156508374.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Luna Blake',
            'voice_name' => 'en-GB-Standard-F',
            'language_code' => 'en-GB',
            'gender' => 'Female',
            'file_name' => '20231207/6d72a1c75ac3478c760246a4382a3158.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":22.1474609375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/412f50f5c4b094f396284fe7ec2359e4.png',
            'file_size' => 22.15,
            'original_file_name' => 'a-beautiful-young-woman-23-years-old-wears-a-blazer-and-skirt-is-sitting-at-a-cafeteria-table-clear - 972738875.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Oliver Thames',
            'voice_name' => 'en-US-Standard-A',
            'language_code' => 'en-US',
            'gender' => 'Male',
            'file_name' => '20231207/2d104c8fe1edc817e7cc44fb08820891.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":21.673828125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/a6d17870a845df5bc95ee0d7cb4d6cc8.png',
            'file_size' => 21.67,
            'original_file_name' => 'conventionally-attractive-twenty-five-year-old-american-man-messy-light-brown-hair-blue-eyes-fit - 176165787.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Henry Bristol',
            'voice_name' => 'en-US-Standard-B',
            'language_code' => 'en-US',
            'gender' => 'Male',
            'file_name' => '20231207/26196f194d5a2e5063f3ac3b25fb091c.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":23.123046875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/91b1d2097402cc5b9b24e88ed47300fe.png',
            'file_size' => 23.12,
            'original_file_name' => 'handsome-twenty-five-year-old-caucasian-man-with-a-tan-short-neat-beard-brown-eyes-shaggy-dirty-b-919261148.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Elsie Oxford',
            'voice_name' => 'en-US-Standard-C',
            'language_code' => 'en-US',
            'gender' => 'Female',
            'file_name' => '20231207/169e583d1e4e031e4c17f723d5f38d1d.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":17.376953125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/6e4e6ef0d9e271617258b239501d6594.png',
            'file_size' => 17.38,
            'original_file_name' => 'women-brown-hair-small-eye-straight-hair-front-low-nose-white-shirts-brown-eye-trending-on-a-443234400.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);


        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Sofia Luz',
            'voice_name' => 'pt-BR-Standard-C',
            'language_code' => 'pt-BR',
            'gender' => 'Female',
            'file_name' => '20231207/eef063f9c5e676f6ffe1a553bb92782d.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":24.1787109375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/b7cb0a03cce07af5e452f9467197b064.png',
            'file_size' => 24.18,
            'original_file_name' => 'young-woman-argentinaie-aborigine-with-delicate-argentinaie-earrings-detailed-delicate-ethnic-earr-106339384.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Lara Costa',
            'voice_name' => 'pt-PT-Standard-A',
            'language_code' => 'pt-PT',
            'gender' => 'Female',
            'file_name' => '20231207/e6d0f3c0066feec62730273cf744df88.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":24.8134765625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/33e815898fb7149cfc356593cccdf7e4.png',
            'file_size' => 24.81,
            'original_file_name' => 'young-woman-inca-aborigine-with-feather-earrings-beautiful-wearing-poncho-long-hair-young-woman - 874209102.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Beatriz Alves',
            'voice_name' => 'pt-PT-Standard-B',
            'language_code' => 'pt-PT',
            'gender' => 'Male',
            'file_name' => '20231207/443326853059ab176e34e8b72757f8ba.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":18.0283203125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/e80a86d1f709b6397efabb26f4732494.png',
            'file_size' => 18.03,
            'original_file_name' => 'an-alluring-and-fierce-israeli-man-with-short-blond-hair-and-brown-eyes-exuding-confidence-and-st-246686631.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Layla Noor',
            'voice_name' => 'ar-XA-Standard-D',
            'language_code' => 'ar-XA',
            'gender' => 'Female',
            'file_name' => '20231207/17d23cd2f3c4f3577a2b338f8598018b.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":20.16796875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/d7cf88be33cde685dcc4d2189fabed45.png',
            'file_size' => 20.17,
            'original_file_name' => 'stylized-fantasy-portrait-of-a-beautiful-casual-smiling-young-desert-woman-wearing-adventurous-dark - 393326593.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Amir Fahad',
            'voice_name' => 'ar-XA-Standard-C',
            'language_code' => 'ar-XA',
            'gender' => 'Male',
            'file_name' => '20231207/8547c3854ac1f64a3d19850c68d0f91d.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":20.3740234375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/27b2833ffdb3eb4ae3ff73cf5b24ebfd.png',
            'file_size' => 20.37,
            'original_file_name' => 'a-handsome-arab-young-man-without-a-hat-tells-stories-of-history-miki-asai-macro-photography-close-452297249.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Valentina Rojas',
            'voice_name' => 'es-ES-Standard-C',
            'language_code' => 'es-ES',
            'gender' => 'Female',
            'file_name' => '20231207/bbf999009a137d372d99d39097eafcf3.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":21.18359375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/e932e83551a2037a6330af5b1bae96b5.png',
            'file_size' => 21.18,
            'original_file_name' => 'hermosa-seorita-18-aos-pelo-castao-largo-ligera-sonrisa-blusa-ligera-plano-medio-corto-4k-real-341677079.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Lucia Perez',
            'voice_name' => 'es-ES-Standard-D',
            'language_code' => 'es-ES',
            'gender' => 'Female',
            'file_name' => '20231207/871cf3233cb90653b1d1d87597a04e11.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":17.1337890625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/c9f5d978eef0c65db49a58c7b6eb6afc.png',
            'file_size' => 17.13,
            'original_file_name' => 'color-de-saco-negro-745032347.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Felix Stern',
            'voice_name' => 'de-DE-Standard-C',
            'language_code' => 'de-DE',
            'gender' => 'Female',
            'file_name' => '20231207/f3bd234d702e0f3d33ea826fdb51b31d.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":17.802734375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/183c7a31952d424571877d9d8a234c7c.png',
            'file_size' => 17.8,
            'original_file_name' => 'irma-grese - 1942-nazi - highly-detailed-professional-digital-painting-unreal-engine-5-photorealis-687672529.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Simon Mond',
            'voice_name' => 'de-DE-Standard-D',
            'language_code' => 'de-DE',
            'gender' => 'Male',
            'file_name' => '20231207/648e4762fe68b8f6be9d7e33b45a7486.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":18.177734375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/c82a41040d545eff79bf4ed9e3d5daab.png',
            'file_size' => 18.18,
            'original_file_name' => '25-year-old-belgian-man-portrait-backlighting-head-only-slightly-overweight-broad-round-face-f-804028795.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Paul Kirsch',
            'voice_name' => 'de-DE-Standard-E',
            'language_code' => 'de-DE',
            'gender' => 'Male',
            'file_name' => '20231207/593585fb1cd2d97cd6dc7942ddcc6522.mp3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":21.08984375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_name' => '20231207/87892a8b78128e02bf9620a66719453b.png',
            'file_size' => 21.09,
            'original_file_name' => 'a-realistic-photo-of-a-handsome-young-man-of-germanic-descent-close-cropped-hair-strong-features - 755550577.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

    }
}
