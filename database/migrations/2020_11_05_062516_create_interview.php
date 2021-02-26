<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interview', function (Blueprint $table) {
            $table->id('interviewid');
            $table->integer('statusid');
            $table->integer('id');
            $table->dateTime('ctualinterviewtime');
            $table->string('interviewnote',200)->nullable($value = true);
            $table->string('pesonalcandidatestestimony',200)->nullable($value = true);
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
        Schema::dropIfExists('interview');
    }
}
