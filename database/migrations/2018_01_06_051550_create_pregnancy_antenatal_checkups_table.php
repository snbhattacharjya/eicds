<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePregnancyAntenatalCheckupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancy_antenatal_checkups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('family_id');
            $table->integer('member_id');
            $table->integer('pregnancy_id');
            $table->smallInteger('target_type_id');
            $table->tinyInteger('age');
            $table->integer('anganwadi_centre_id');
            $table->enum('anganwadi_resident',['Y','N']);
            $table->string('checkup_place');
            $table->date('checkup_date');
            $table->string('doctor_name')->nullable();
            $table->string('remarks');
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
        Schema::dropIfExists('pregnancy_antenatal_checkups');
    }
}
