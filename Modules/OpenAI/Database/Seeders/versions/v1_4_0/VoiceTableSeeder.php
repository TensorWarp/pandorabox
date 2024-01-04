<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

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
            'name' => 'Oliva Watson',
            'voice_name' => 'en-GB-Standard-A',
            'language_code' => 'en-GB',
            'gender' => 'Female',
            'file_name' => '20231007/e6367158209c88c574897cf59d76df57.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":36.43359375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 36.43,
            'file_name' => '20231007/6a0a67163cb2e7b9ab02b84f691d9305.png',
            'original_file_name' => '100-years-ago-the-figure-of-a-smile-womanoid-reflecting-the-style-of-dress-in-the-23th-century-ele-969506291.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Alexander Smith',
            'voice_name' => 'en-GB-Standard-B',
            'language_code' => 'en-GB',
            'gender' => 'Male',
            'file_name' => '20231007/b75d07163740090aad47cb0e3b5c2a53.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":25.34765625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 25.35,
            'file_name' => '20231007/bafb7886bc935b538fd4625c9a56167e.png',
            'original_file_name' => 'a-handsome-young-man-of-age-28-wearing-suit-looking-forwardmasculineconfidentdark-soft-background-892812288.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Anika Sen',
            'voice_name' => 'bn-IN-Standard-A',
            'language_code' => 'bn-IN',
            'gender' => 'Female',
            'file_name' => '20231007/ac01756094518729171fb7c8e14fbf3e.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":26.9033203125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 26.9,
            'file_name' => '20231007/940a5da2219e1ff2dd821f2e1dd52505.png',
            'original_file_name' => 'full-scene-modern-bengali-girl-teenager-girl-normal-saree-long-black-hair-head-and-shoulders-po-656062952.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Aarav Dasgupta',
            'voice_name' => 'bn-IN-Standard-B',
            'language_code' => 'bn-IN',
            'gender' => 'Male',
            'file_name' => '20231007/7d0929368a8849ef25580799d6c8844e.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":29.783203125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 29.78,
            'file_name' => '20231007/612121884d8f0902a50b7bbeeb42198d.png',
            'original_file_name' => 'olpntng-style-full-head-photorealistic-photorealism-golden-ratio-present-day-attiretrendin-3905584.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Sophie Lefebvre',
            'voice_name' => 'fr-CA-Standard-A',
            'language_code' => 'fr-CA',
            'gender' => 'Female',
            'file_name' => '20231007/5b3f7d48e95da0e0806b2ceb894fb318.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":39.650390625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 39.65,
            'file_name' => '20231007/e7125b837753faa9de628013f1c42998.png',
            'original_file_name' => 'beautiful-woman-writer-brown-blonde-brown--eyes-round-frame-glasses-cute-face-ultra-detailed-i-189023692.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Jean Martin',
            'voice_name' => 'fr-CA-Standard-B',
            'language_code' => 'fr-CA',
            'gender' => 'Male',
            'file_name' => '20231007/78cda68fd07cb4d5e56011125718f995.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":24.4404296875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 24.44,
            'file_name' => '20231007/add676aa81f7b015cca6b2ae2d3bb210.png',
            'original_file_name' => 'a-ultra-realistic-portrait-of-a-charismatic-40-year-old-man-named-luiz-da-silva-perfect-composition-534792854.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Li Wei',
            'voice_name' => 'yue-HK-Standard-A',
            'language_code' => 'yue-HK',
            'gender' => 'Female',
            'file_name' => '20231007/806b3b78cb6f9131a0f1ff8c0b06f6be.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":35.322265625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 35.32,
            'file_name' => '20231007/e4c0f1a201e9ae05a16d3086175103af.png',
            'original_file_name' => 'xi-jin-ping-clear-bright-eyes-head-and-shoulders-portrait-detailed-and-intricate-environment-4k-7860793.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Zhang Ming',
            'voice_name' => 'yue-HK-Standard-B',
            'language_code' => 'yue-HK',
            'gender' => 'Male',
            'file_name' => '20231007/6024c6b2b58a74a920d546504d21df45.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":23.73046875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 23.73,
            'file_name' => '20231007/6956261ea5765a2f09c551dda78b724f.png',
            'original_file_name' => 'handsome-23-years-old-korean-male-with-shirt-double-eyelids-straight-nose-beautiful-clean-face-f-35782559.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Fatima Ali',
            'voice_name' => 'ar-XA-Standard-A',
            'language_code' => 'ar-XA',
            'gender' => 'Female',
            'file_name' => '20231007/3a4718972af6cf1ae1eefad6e96349da.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":32.0380859375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 32.04,
            'file_name' => '20231007/4ede9083362d921883ff3f25cd713516.png',
            'original_file_name' => 'asian-modern-and-beautiful-hijab-girl-blue-hijab-color-plain-white-background-color-4k-hd-supe-563824481.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Ahmed Khan',
            'voice_name' => 'ar-XA-Standard-B',
            'language_code' => 'ar-XA',
            'gender' => 'Male',
            'file_name' => '20231007/6b20b576b8b73c91cae77abd5cdba35f.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":27.1220703125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 27.12,
            'file_name' => '20231007/e910d5fdf52c2ac080289e1223217fff.png',
            'original_file_name' => 'a-moroccan-young-man-in-peasant-clothes-30-years-old-with-good-features-appears-to-have-a-kind-he-504078789.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Maria Georgieva',
            'voice_name' => 'bg-BG-Standard-A',
            'language_code' => 'bg-BG',
            'gender' => 'Female',
            'file_name' => '20231007/8e727887558125a6ec46ee1ee426ad61.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":45.037109375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 45.04,
            'file_name' => '20231007/eeec1a490559d5290c2d006585fbf7e9.png',
            'original_file_name' => 'good-looking-young-femaleindigo-colorportrait-of-an-urban-good-looking-young-female-trending--337805477.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Marta Roca',
            'voice_name' => 'ca-ES-Standard-A',
            'language_code' => 'ca-ES',
            'gender' => 'Female',
            'file_name' => '20231007/bc0500430bb6397a1fa95be8a5653af8.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":25.416015625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 25.42,
            'file_name' => '20231007/ee9e7c3e94faa77629b773a9e7cd50dc.png',
            'original_file_name' => 'ilse-koch-buchenwald-1942-nazi-highly-detailed-professional-digital-painting-unreal-engine-5-pho-334769933.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Anna Bakker',
            'voice_name' => 'nl-NL-Standard-A',
            'language_code' => 'nl-NL',
            'gender' => 'Female',
            'file_name' => '20231007/43057997c83cdfc322118c5bb3d58e8e.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":42.111328125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 42.11,
            'file_name' => '20231007/035bde6bf2f678cbc00b5d22ac032fc2.png',
            'original_file_name' => 'painting-of-beautiful-young-woman-in-style-of-jeremy-mann-cinematic-4k-epic-steven-spielberg--741507031.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Pieter Janssen',
            'voice_name' => 'nl-NL-Standard-B',
            'language_code' => 'nl-NL',
            'gender' => 'Male',
            'file_name' => '20231007/bf6f25d59663808c61c1809969ca151f.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":30.1904296875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 30.19,
            'file_name' => '20231007/aa6ec42b98fa1c92744e3ba195536b9b.png',
            'original_file_name' => 'business-man-997159448.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Olga Kuznetsova',
            'voice_name' => 'ru-RU-Standard-A',
            'language_code' => 'ru-RU',
            'gender' => 'Female',
            'file_name' => '20231007/758a12b1e1aeb91cea77c2267417de2b.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":22.845703125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 22.85,
            'file_name' => '20231007/efad894c4cc7512cdc1b51b27f51f3eb.png',
            'original_file_name' => 'pixar-portrait-style-woman-painted-background-soft-lighting-589346799.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Alexei Sokolov',
            'voice_name' => 'ru-RU-Standard-B',
            'language_code' => 'ru-RU',
            'gender' => 'Male',
            'file_name' => '20231007/277be8c4407af3bb04011d3f408864b5.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":27.0849609375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 27.08,
            'file_name' => '20231007/2a49b1b158e311119f61c44c8465d910.png',
            'original_file_name' => 'man-with-glasses-with-mustage-and-small-beard-only-on-his-chin--641033038.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Ana Martínez',
            'voice_name' => 'es-ES-Standard-A',
            'language_code' => 'es-ES',
            'gender' => 'Female',
            'file_name' => '20231007/3749de7e932abc110bd8aa79bad882e4.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":22.537109375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 22.54,
            'file_name' => '20231007/0beb148526429036d054618558439ece.png',
            'original_file_name' => 'portrait-of-an-adult-woman-40-yo-chromakey-beautiful-detailed-intricate-insanely-detailed-octane--229190450.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Carlos Rodríguez',
            'voice_name' => 'es-ES-Standard-B',
            'language_code' => 'es-ES',
            'gender' => 'Male',
            'file_name' => '20231007/e06889086f86d01b87140734c63c67c7.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":30.8720703125,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 30.87,
            'file_name' => '20231007/2ed1c5393bb46bc1937a94393b3710a6.png',
            'original_file_name' => 'portrait-of-detailed-very-beautiful-male-with--haughty-smile-make-a-selfi-beautiful-sexy-make-sel-75979952.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Sofia Ferreira',
            'voice_name' => 'pt-BR-Standard-A',
            'language_code' => 'pt-BR',
            'gender' => 'Female',
            'file_name' => '20231007/4c19abbc46f3dc2252e3a8cc63fb935e.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":38.59765625,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 38.6,
            'file_name' => '20231007/48149d04f4f6db5532d0ada05ca5498f.png',
            'original_file_name' => 'a-close-up-of-a-irish-womans-face-extremely-detailed-detailed-eyes-detailed-lips-with-a-backdro-244215745.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Pedro Pereira',
            'voice_name' => 'pt-BR-Standard-B',
            'language_code' => 'pt-BR',
            'gender' => 'Male',
            'file_name' => '20231007/bbe15c8f9882fc164eb89264ca28a3fd.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'params' => '{"size":24.171875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 24.17,
            'file_name' => '20231007/ffd3bb38e93d6472904c5d410a03f733.png',
            'original_file_name' => 'ultra-realistic-digital-illustration-of-50-years-old-man-similar-with-uploaded-photo-intricate-deta-244647170.png',
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Anna Nowak',
            'voice_name' => 'pl-PL-Standard-A',
            'language_code' => 'pl-PL',
            'gender' => 'Female',
            'file_name' => '20231007/7a716295243e1a71d634fd45cf4232f2.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'file_name' => '20231007/5c2965b9f74e3a2e2b3878c43be6a382.png',
            'original_file_name' => 'female27-years-oldlovely-pretty-cute-niceblond-hairvery-long-hairglassesvintage-fashi-10664113.png',
            'params' => '{"size":48.8671875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 48.87,
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Marek Kowalski',
            'voice_name' => 'pl-PL-Standard-B',
            'language_code' => 'pl-PL',
            'gender' => 'Male',
            'file_name' => '20231007/f09253b40aa3fa79d89aa7eb0daa9d7b.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'file_name' => '20231007/7a2bc624efef3702f499c778858d2327.png',
            'original_file_name' => 'business-man-in-an-elegant-office-sitting-in-a-high-backed-chair-in-a-fine-italian-suit-35-years-818565589.png',
            'params' => '{"size":39.8984375,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 39.9,
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Laura Fischer',
            'voice_name' => 'de-DE-Standard-A',
            'language_code' => 'de-DE',
            'gender' => 'Female',
            'file_name' => '20231007/0ce1422876916c436281eb78644a5edf.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'file_name' => '20231007/a1aa430a949c13d17d93f8a002a61ea8.png',
            'original_file_name' => 'a-colorful-illustration--of-a-beautiful-woman-reading-a-book-sticker-style-colorful-sticker-2d-c-686460080.png',
            'params' => '{"size":35.779296875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 35.78,
        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);

        $voiceId = DB::table('voices')->insertGetId([
            'name' => 'Stefan Wagner',
            'voice_name' => 'de-DE-Standard-B',
            'language_code' => 'de-DE',
            'gender' => 'Male',
            'file_name' => '20231007/c049f7f87760fa7d6567262f3162c79a.MP3',
            'status' => 'Active',
        ]);
        $fileId = DB::table('files')->insertGetId([
            'file_name' => '20231007/a1b6bd47771bdd70eb59dfba3b9cab80.png',
            'params' => '{"size":25.998046875,"type":"png"}',
            'object_type' => 'png',
            'object_id' => NULL,
            'uploaded_by' => 1,
            'file_size' => 26.0,
            'original_file_name' => 'a-man-standing-outside-with-a-microphone-935719209.png',

        ]);
        DB::table('object_files')->insert([
            'object_type' => 'voices',
            'object_id' => $voiceId,
            'file_id' => $fileId,
        ]);
    }
}
