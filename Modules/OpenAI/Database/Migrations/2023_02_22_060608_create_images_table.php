<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id');
            $table->string('name', 191);
            $table->string('original_name', 191);
            $table->text('promt');
            $table->string('slug', 191);
            $table->string('size', 191);
            $table->string('art_style', 191);
            $table->string('lighting_style', 191);
            $table->string('libraries', 191);
            $table->text('meta')->nullable();
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
        Schema::table('images', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });

        Schema::dropIfExists('images');
    }
}
