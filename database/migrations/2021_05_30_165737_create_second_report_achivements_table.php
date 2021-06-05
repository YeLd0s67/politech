<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondReportAchivementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_report_achivements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('topic');
            $table->string('contest');
            $table->string('place');
            $table->string('year');
            $table->string('level');
            $table->string('date');
            $table->string('win');
            $table->string('id_no');
            $table->string('diplom');
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
        Schema::dropIfExists('second_report_achivements');
    }
}
