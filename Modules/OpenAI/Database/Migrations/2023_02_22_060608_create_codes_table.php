<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('user_id');
            $table->string('model', 191);
            $table->string('slug', 191);
            $table->text('promt');
            $table->text('code');
            $table->integer('tokens');
            $table->integer('words');
            $table->integer('characters');
            $table->string('language', 191);
            $table->string('code_label', 191);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();   
            
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('codes', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
        });
        Schema::dropIfExists('codes');
    }
}
