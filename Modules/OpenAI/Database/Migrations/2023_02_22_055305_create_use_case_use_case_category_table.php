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
        Schema::create('use_case_use_case_category', function (Blueprint $table) {
            $table->unsignedBigInteger('use_case_id');
            $table->unsignedBigInteger('use_case_category_id');
        });

        Schema::table('use_case_use_case_category', function (Blueprint $table) {
            $table->foreign('use_case_id')->references('id')->on('use_cases')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('use_case_category_id')->references('id')->on('use_case_categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('use_case_use_case_category', function (Blueprint $table) {
            $table->dropForeign(['use_case_category_id', 'use_case_id']);
        });

        Schema::dropIfExists('use_case_use_case_category');
    }
};
