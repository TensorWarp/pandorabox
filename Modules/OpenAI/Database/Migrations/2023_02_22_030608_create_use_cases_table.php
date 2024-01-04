<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->index();
            $table->string('description', 1000);
            $table->string('slug', 191)->unique();
            $table->text('prompt');
            $table->string('creator_type', 191)->index()->comment('User Type');
            $table->bigInteger('creator_id', false, true)->index()->comment('User ID');
            $table->string('status', 191);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_cases', function (Blueprint $table) {
            $table->dropIndex(['id', 'name', 'creator_type', 'creator_id']);
            $table->dropUnique(['slug']);
        });

        Schema::dropIfExists('use_cases');
    }
};
