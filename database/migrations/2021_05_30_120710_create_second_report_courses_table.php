<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondReportCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_report_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->string('programm');
            $table->string('subject');
            $table->string('type');
            $table->string('lang');
            $table->string('date');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('year');
            $table->string('certificate_no');
            $table->string('certificate_picture');
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
        Schema::dropIfExists('second_report_courses');
    }
}
