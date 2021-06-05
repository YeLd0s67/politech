<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_reports_strucs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sanat');
            $table->string('sanat_start_date');
            $table->string('sanat_end_date');
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
        Schema::dropIfExists('reports');
    }
}
