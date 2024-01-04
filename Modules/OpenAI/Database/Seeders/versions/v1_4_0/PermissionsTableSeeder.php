<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_4_0;

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
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController@index',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController',
            'controller_name' => 'ChatCategoriesController',
            'method_name' => 'index',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController@create',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController',
            'controller_name' => 'ChatCategoriesController',
            'method_name' => 'create',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController@edit',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController',
            'controller_name' => 'ChatCategoriesController',
            'method_name' => 'edit',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController@destroy',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatCategoriesController',
            'controller_name' => 'ChatCategoriesController',
            'method_name' => 'destroy',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController@index',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController',
            'controller_name' => 'ChatAssistantsController',
            'method_name' => 'index',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);
        
        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController@create',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController',
            'controller_name' => 'ChatAssistantsController',
            'method_name' => 'create',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController@edit',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController',
            'controller_name' => 'ChatAssistantsController',
            'method_name' => 'edit',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController@destroy',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\ChatAssistantsController',
            'controller_name' => 'ChatAssistantsController',
            'method_name' => 'destroy',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);
        
        // Text To Speech
        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\TextToSpeechController',
            'method_name' => 'index',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\TextToSpeechController@index',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\TextToSpeechController',
            'method_name' => 'show',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\TextToSpeechController@show',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\TextToSpeechController',
            'method_name' => 'delete',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\TextToSpeechController@delete',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 1,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController',
            'method_name' => 'textToSpeechTemplate',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController@textToSpeechTemplate',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController',
            'method_name' => 'textToSpeechList',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController@textToSpeechList',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController',
            'method_name' => 'show',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController@show',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController',
            'method_name' => 'delete',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController@delete',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController',
            'method_name' => 'destroy',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\TextToSpeechController@destroy',
        ]);
        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController',
            'method_name' => 'textToSpeech',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController@textToSpeech',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\UserController@destroy',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\UserController',
            'controller_name' => 'UserController',
            'method_name' => 'destroy',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 526,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 527,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 528,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 532,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 514,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 515,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 523,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 524,
            'role_id' => 2,
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => 525,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController',
            'method_name' => 'index',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController@index',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController',
            'method_name' => 'show',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController@show',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'TextToSpeechController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController',
            'method_name' => 'destroy',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\TextToSpeechController@destroy',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);
    }
}