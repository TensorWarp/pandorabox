<?php

namespace Modules\OpenAI\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\OpenAI\Database\Seeders\versions\v1_2_0\PermissionTableSeeder;
use Modules\OpenAI\Database\Seeders\versions\v1_2_0\ContentTypeTableSeeder as ContentTypeV12TableSeeder;
use Modules\OpenAI\Database\Seeders\versions\v1_2_0\MenuItemsTableSeeder as MenuItemsV12TableSeeder;

use Modules\OpenAI\Database\Seeders\versions\v1_4_0\DatabaseSeeder as DatabaseSeederV14;
use Modules\OpenAI\Database\Seeders\versions\v1_5_0\DatabaseSeeder as DatabaseSeederV15;
use Modules\OpenAI\Database\Seeders\versions\v1_6_0\DatabaseSeeder as DatabaseSeederV16;

class OpenAIDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UseCaseCategoriesTableSeeder::class);
        $this->call(UseCasesTableSeeder::class);
        $this->call(UseCaseUseCaseCategoryTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(OptionMetaTableSeeder::class);
        $this->call(ContentTypeTableSeeder::class);
        $this->call(ContentTypeMetaTableSeeder::class);

        $this->call(ContentsTableSeeder::class);
        $this->call(CodesTableSeeder::class);

        $this->call(AdminMenusTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);

        $this->call(MenuItemsV12TableSeeder::class);

        $this->call(ChatCategoriesTableSeeder::class);
        $this->call(ChatBotsTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(ContentTypeV12TableSeeder::class);

        $this->call(DatabaseSeederV14::class);

        $this->call(DatabaseSeederV15::class);

        $this->call(DatabaseSeederV16::class);
    }
}
