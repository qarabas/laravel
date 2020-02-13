<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('files');
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->unique();
            $table->bigInteger('dir_id')->unsigned();
            $table->foreign('dir_id')->references('id')->on('dirs')->onDelete('cascade');
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
