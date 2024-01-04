<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_conversation_id');
            $table->bigInteger('user_id')->nullable();
            $table->text('user_message')->nullable();
            $table->unsignedBigInteger('bot_id')->nullable();
            $table->text('bot_message')->nullable();
            $table->integer('tokens');
            $table->integer('words');
            $table->integer('characters');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();   

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bot_id')->references('id')->on('chat_bots')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('chat_conversation_id')->references('id')->on('chat_conversations')->onDelete('cascade')->onUpdate('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chatchats_bots', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'bot_id', 'chat_conversation_id']);
        });

        Schema::dropIfExists('chats');
    }
}
