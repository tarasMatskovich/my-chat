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
            $table->increments('id');
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('read_at')->nullable();
            $table->boolean('type'); // 0 - is for send, 1 - is for receive
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
        Schema::dropIfExists('chats');
    }
}
