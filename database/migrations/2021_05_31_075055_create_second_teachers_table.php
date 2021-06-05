<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('iin');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->date('date_birth');
            $table->string('gender');
            $table->string('citizen');
            $table->string('other_citizen');
            $table->string('nation');
            $table->string('other_nation');
            $table->string('current_status');
            $table->string('rank');
            $table->string('type_of_busy');
            $table->string('academic_degree');
            $table->string('degree');
            $table->string('studying');
            $table->string('pre_work_history');
            $table->string('curr_overall_work_history');
            $table->string('curr_ped_work_history');
            $table->string('company_work_history');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('sanat');
            $table->string('lang');
            $table->string('english_level');
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
        Schema::dropIfExists('second_teachers');
    }
}
