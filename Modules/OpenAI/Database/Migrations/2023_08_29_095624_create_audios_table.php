<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audios', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id');
            $table->string('file_name', 191);
            $table->string('voice', 191);
            $table->integer('characters');
            $table->text('prompt');
            $table->string('slug', 191);
            $table->string('language', 191);
            $table->string('volume', 11);
            $table->string('gender', 11);
            $table->string('pitch', 11);
            $table->string('speed', 11);
            $table->string('pause', 11);
            $table->string('audio_effect', 191)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();   
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('audios', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });

        Schema::dropIfExists('audios');
    }
}
