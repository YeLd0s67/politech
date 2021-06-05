<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('place');
            $table->string('programm');
            $table->string('subject');
            $table->string('type');
            $table->string('lang');
            $table->string('date');
            $table->string('certificate_no');
            $table->string('certificate_picture');
            $table->string('year');
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
        Schema::dropIfExists('report_courses');
    }
}
