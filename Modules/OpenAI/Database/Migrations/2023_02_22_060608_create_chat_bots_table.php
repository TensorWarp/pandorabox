<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_bots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_category_id');
            $table->string('name', 191)->index();
            $table->string('code', 15);
            $table->string('message', 191);
            $table->string('role', 191);
            $table->text('promt');
            $table->string('status', 15);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();          
        });

        Schema::table('chat_bots', function (Blueprint $table) {
            $table->foreign('chat_category_id')->references('id')->on('chat_categories')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_bots', function (Blueprint $table) {
            $table->dropIndex(['name', 'chat_category_id']);
        });

        Schema::dropIfExists('chat_bots');
    }
}
