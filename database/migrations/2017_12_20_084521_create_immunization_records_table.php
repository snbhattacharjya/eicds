<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmunizationRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immunization_records', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('family_id');
          $table->integer('member_id');
          $table->smallInteger('target_type_id');
          $table->tinyInteger('age');
          $table->integer('anganwadi_centre_id');
          $table->integer('vaccination_id');
          $table->date('vaccination_due_date');
          $table->date('vaccination_admin_date');
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
        Schema::dropIfExists('immunization_records');
    }
}
