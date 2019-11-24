<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('dirs');
        Schema::create('dirs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255)->unique();
            $table->bigInteger('cell_id')->unsigned();
            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
            $table->timestamps();
        });
//        Schema::create('dirs', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('title', 255)->unique();
//            $table->bigInteger('cell_id')->unsigned();
//            $table->foreign('cell_id')->references('id')->on('cells')->onDelete('cascade');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dirs');
    }
}
