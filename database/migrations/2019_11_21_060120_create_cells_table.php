<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('cells');
        Schema::create('cells', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->unique();
            $table->bigInteger('arch_id')->unsigned();
            $table->foreign('arch_id')->references('id')->on('arches')->onDelete('cascade');
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
        Schema::dropIfExists('cells');
    }
}
