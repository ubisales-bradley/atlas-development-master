<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSources extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {

            $table->uuid('id')->primary();
            $table->uuid('account_id');
            $table->string('identifier',255);
            $table->foreignId('type_id');
            $table->foreignId('gateway_id');
            $table->json('credentials')->nullable();
            $table->uuid('parent_id');
            $table->boolean('active');
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
        Schema::dropIfExists('sources');
    }
}
