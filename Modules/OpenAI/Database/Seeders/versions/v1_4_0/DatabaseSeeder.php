<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminMenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(ChatCategoriesTableSeeder::class);
        $this->call(ChatBotsTableSeeder::class);
        $this->call(VoiceTableSeeder::class);
        $this->call(ContentTypeTableSeeder::class);
    }
}
