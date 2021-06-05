<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondReportInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_report_internships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prof');
            $table->string('place');
            $table->string('employement');
            $table->string('date');
            $table->string('end_date');
            $table->string('message');
            $table->string('pic');
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
        Schema::dropIfExists('second_report_internships');
    }
}
