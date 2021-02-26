<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewbyclient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviewbyclient', function (Blueprint $table) {
            $table->id('interviewid');
            $table->string('interviewbyclientdescription',250);
            $table->integer('statusclientid');
            $table->string('interviewername',30);
            $table->string('interviewjobposition',50);
            $table->string('company',50);
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
        Schema::dropIfExists('interviewbyclient');
    }
}
