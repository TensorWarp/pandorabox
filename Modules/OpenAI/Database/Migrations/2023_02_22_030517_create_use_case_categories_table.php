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
        Schema::create('use_case_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->index();
            $table->string('slug', 191)->unique();
            $table->string('description', 1000);
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
        Schema::table('use_case_categories', function (Blueprint $table) {
            $table->dropIndex(['id', 'name']);
            $table->dropUnique(['slug']);
        });

        Schema::dropIfExists('use_case_categories');
    }
};
