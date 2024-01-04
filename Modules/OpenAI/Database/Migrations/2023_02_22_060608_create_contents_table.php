<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->BigInteger('user_id');
            $table->unsignedBigInteger('use_case_id');
            $table->string('title', 191);
            $table->string('slug', 3000);
            $table->text('promt');
            $table->text('content');
            $table->integer('tokens');
            $table->integer('words');
            $table->integer('characters');
            $table->string('model', 191);
            $table->string('language', 191);
            $table->string('tone', 191);
            $table->float('creativity_label');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });

        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('contents')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('use_case_id')->references('id')->on('use_cases')->onUpdate('cascade')->onDelete('cascade');
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
            $table->dropIndex(['parent_id', 'user_id', 'use_case_id']);
        });

        Schema::dropIfExists('contents');
    }
}
