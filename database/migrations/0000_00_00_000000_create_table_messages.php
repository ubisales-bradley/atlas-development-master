<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->enum('direction',['RT','RO']);
            $table->uuid('account_id');
            $table->uuid('recipient_id');
            $table->foreignId('content_id');
            $table->uuid('source_id');
            $table->string('external_id','255')->nullable();
            $table->foreignId('status_id');
            $table->timestamp('send_at');
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
