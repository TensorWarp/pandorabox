<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_5_0;

use App\Models\Model;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();

        // Chat
        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\ChatController@allChatAssistants',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\ChatController',
            'controller_name' => 'ChatController',
            'method_name' => 'allChatAssistants',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

    }
}