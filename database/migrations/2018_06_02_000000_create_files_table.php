<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('original_name')->nullable();
            $table->string('type', 16)->nullable();
            $table->string('extension', 8)->nullable();
            $table->integer('size', false, true)->default(0);
            $table->json('thumbnails')->default('{}');
            $table->string('folder')->nullable();

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
        Schema::dropIfExists('files');
    }
}
