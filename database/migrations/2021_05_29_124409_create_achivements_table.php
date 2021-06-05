<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchivementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achivements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('groups');
            $table->string('advisor');
            $table->string('shara');
            $table->string('level');
            $table->string('shara_name');
            $table->string('period');
            $table->string('achivement');
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
        Schema::dropIfExists('achivements');
    }
}
