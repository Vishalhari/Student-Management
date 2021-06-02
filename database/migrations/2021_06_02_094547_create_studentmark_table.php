<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentmarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentmark', function (Blueprint $table) {
            $table->id();
            $table->integer('studentId');
            $table->integer('termId');
            $table->integer('maths_mark');
            $table->integer('science_mark');
            $table->integer('history_mark');
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
        Schema::dropIfExists('studentmark');
    }
}
