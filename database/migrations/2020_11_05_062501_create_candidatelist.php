<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatelist extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatelist', function (Blueprint $table) {
            $table->increments('candidatelistid');
            $table->string('fullname',30);
            $table->string('email',30);
            $table->string('mobilephone',13);
            $table->string('niknumber',16);
            $table->string('notecandidate',200);
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
        Schema::dropIfExists('candidatelist');
    }
}
