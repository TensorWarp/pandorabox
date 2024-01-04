<?php

namespace Modules\OpenAI\Database\Seeders\versions\v1_2_0;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController@index',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'index',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController@edit',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'edit',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController@update',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'update',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController@delete',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Admin\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'delete',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController@speechTemplate',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'speechTemplate',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController@speechLists',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'speechLists',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController@editSpeech',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'editSpeech',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController@updateSpeech',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'updateSpeech',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController@deleteSpeech',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Customer\\SpeechToTextController',
            'controller_name' => 'SpeechToTextController',
            'method_name' => 'deleteSpeech',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'OpenAIController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\OpenAIController',
            'method_name' => 'speechToText',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\OpenAIController@speechToText',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'SpeechToTextController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController',
            'method_name' => 'index',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController@index',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'SpeechToTextController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController',
            'method_name' => 'show',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController@show',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'SpeechToTextController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController',
            'method_name' => 'edit',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController@edit',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);

        $parentId = Permission::insertGetId([
            'controller_name' => 'SpeechToTextController',
            'controller_path' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController',
            'method_name' => 'destroy',
            'name' => 'Modules\\OpenAI\\Http\\Controllers\\Api\\V1\\User\\SpeechToTextController@destroy',
        ]);

        DB::table('permission_roles')->insert([
            'permission_id' => $parentId,
            'role_id' => 2,
        ]);
    }
}
