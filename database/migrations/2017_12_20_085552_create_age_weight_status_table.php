<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgeWeightStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_weight_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gender',1);
            $table->tinyInteger('age_from');
            $table->tinyInteger('age_to');
            $table->tinyInteger('normal');
            $table->tinyInteger('moderate_under_weight');
            $table->tinyInteger('severely_under_weight');
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
        Schema::dropIfExists('age_weight_statuses');
    }
}
