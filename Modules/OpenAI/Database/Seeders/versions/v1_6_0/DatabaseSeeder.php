<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_6_0;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            VoiceTableSeeder::class,
            ContentTypeTableSeeder::class,
        ]);
    }
}
