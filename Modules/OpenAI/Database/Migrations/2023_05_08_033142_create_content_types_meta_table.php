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
        Schema::create('content_types_meta', function (Blueprint $table) {
            $table->id();
            $table->integer('content_type_id')->index();
            $table->string('name', 100);
            $table->string('key', 100)->index();
            $table->string('value', 1000)->nullable();
            $table->unique(['key', 'content_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_types_meta');
    }
};
