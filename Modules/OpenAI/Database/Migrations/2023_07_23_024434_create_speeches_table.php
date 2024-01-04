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
        Schema::create('speeches', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id');
            $table->text('content');
            $table->float('duration', 8, 2);
            $table->string('language', 191);
            $table->string('file_name', 191)->nullable();
            $table->float('file_size', 8, 2)->nullable();
            $table->string('original_file_name', 191)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
        });

        Schema::table('speeches', function (Blueprint $table) {
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
        Schema::table('speeches', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });

        Schema::dropIfExists('speeches');
    }
};
